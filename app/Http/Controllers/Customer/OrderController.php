<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', auth()->user()->id)
            ->latest()
            ->get();
        return view('customer.orders.index', compact('orders'));
    }

    public function create($commissionId)
    {
        $commission = Commission::findOrFail($commissionId);
        return view('customer.orders.create', compact('commission'));
    }

    // buat nyimpen order baru
    public function store(Request $request, $commissionId)
    {
        $request->validate([
            'note' => 'nullable|string',
            'reference_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $commission = Commission::findOrFail($commissionId);

        // upload foto referensi kalau ada
        $referencePath = null;
        if ($request->hasFile('reference_image')) {
            $referencePath = $request->file('reference_image')->store('references', 'public');
        }

        $order = Order::create([
            'commission_id' => $commission->id,
            'customer_id' => auth()->user()->id,
            'note' => $request->note,
            'reference_image' => $referencePath,
            'status' => 'pending',
            'total' => $commission->price,
        ]);

        return redirect()->route('customer.orders.show', $order->id)->with('success', 'Order berhasil dibuat!');
    }

    // ini buat nampilin detail order
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('customer_id', auth()->user()->id)
            ->firstOrFail();

        return view('customer.orders.show', compact('order'));
    }

    // ini buat customer, bisa cancel order kalaw status komis nya pending
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('customer_id', auth()->user()->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $order->update(['status' => 'cancelled']);

        return redirect()->route('customer.orders.index')->with('success', 'Order berhasil dibatalkan!');
    }
}
