<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getSnapToken($orderId)
    {
        // buat set server key dari dot i en vi
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $order = \App\Models\Order::where('id', $orderId)
            ->where('customer_id', auth()->user()->id)
            ->firstOrFail();

        $params = [
            // ini buat ingfo order (id uniq + jumlah bayar)
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->total,
            ],
            // ingfo cust yg bayar
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        // minta token dari midtrans, nanti dipake buat munculin popup bayar hayu bayar
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->all();

        \Log::info('Midtrans Notification Received:', $payload);

        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;

        preg_match('/ORDER-(\d+)-/', $orderId, $matches);
        $realOrderId = $matches[1] ?? null;

        if (!$realOrderId) {
            return response()->json(['message' => 'Invalid order id'], 400);
        }

        $order = \App\Models\Order::find($realOrderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $order->update(['status' => 'in_progress']);
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny') {
            $order->update(['status' => 'rejected']);
        }

        \Log::info('Order updated. New status: ' . $order->status);

        return response()->json(['message' => 'OK']);
    }
}
