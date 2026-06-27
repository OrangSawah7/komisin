<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getSnapToken($orderId)
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $order = \App\Models\Order::where('id', $orderId)
            ->where('customer_id', auth()->user()->id)
            ->firstOrFail();

        // Cek afakahh ada payment yang masih aktif (belum 24 jam & masih pending)
        $existingPayment = \App\Models\Payment::where('order_id', $order->id)
            ->where('status', 'pending')
            ->where('created_at', '>=', now()->subHours(24))
            ->latest()
            ->first();

        if ($existingPayment) {
            // Pakai snap_token yang dah ada, gaperlu request baru ke Midtrans
            return response()->json(['snap_token' => $existingPayment->snap_token]);
        }

        // Belum ada / sudah expired, generate order_id dan snap_token baru
        $midtransOrderId = 'ORDER-' . $order->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $midtransOrderId,
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'expiry' => [
                'unit' => 'hours',
                'duration' => 24,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpen ke database
        \App\Models\Payment::create([
            'order_id' => $order->id,
            'midtrans_order_id' => $midtransOrderId,
            'snap_token' => $snapToken,
            'amount' => $order->total,
            'status' => 'pending',
        ]);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->all();

        \Log::info('Midtrans Notification Received:', $payload);

        $midtransOrderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;

        preg_match('/ORDER-(\d+)-/', $midtransOrderId, $matches);
        $realOrderId = $matches[1] ?? null;

        if (!$realOrderId) {
            return response()->json(['message' => 'Invalid order id'], 400);
        }

        $order = \App\Models\Order::find($realOrderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $payment = \App\Models\Payment::where('midtrans_order_id', $midtransOrderId)->first();

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $order->update(['status' => 'in_progress']);
            $payment?->update(['status' => 'paid']);
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny') {
            $order->update(['status' => 'rejected']);
            $payment?->update(['status' => 'failed']);
        } elseif ($transactionStatus == 'expire') {
            $payment?->update(['status' => 'expired']);
        }

        // ?-> tuh buat null-safe-operator cik, jd klaw $payment nya null, barisnya otomatis ke-skip, gx error
        \Log::info('Order updated. New status: ' . $order->status);

        return response()->json(['message' => 'OK']);
    }
}
