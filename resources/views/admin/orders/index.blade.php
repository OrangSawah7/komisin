@extends('layouts.dashboard')

@section('title', 'Kelola Order')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link">
        <i class="fas fa-paint-brush"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link active">
        <i class="fas fa-box"></i> Kelola Order
    </a>
    <a href="/admin/users" class="nav-link">
        <i class="fas fa-users"></i> Kelola User
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #CB2957; color: #fff;">
            {{ session('success') }}
        </div>
    @endif

    <h5 class="fw-bold mb-4">Kelola Order</h5>

    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        @if($orders->isEmpty())
            <p style="opacity:0.5;">Belum ada order masuk.</p>
        @else
            <table class="table table-borderless" style="color: #fff;">
                <thead>
                    <tr style="border-bottom: 1px solid #333;">
                        <th style="opacity:0.5;">#</th>
                        <th style="opacity:0.5;">Customer</th>
                        <th style="opacity:0.5;">Komisi</th>
                        <th style="opacity:0.5;">Total</th>
                        <th style="opacity:0.5;">Status</th>
                        <th style="opacity:0.5;">Tanggal</th>
                        <th style="opacity:0.5;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr style="border-bottom: 1px solid #222;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->commission->title }}</td>
                        <td style="color: #CB2957;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge rounded-pill" style="background-color: #CB2957;">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-outline-dark rounded-pill px-3 mb-2 d-block">
                                👁 Detail
                            </a>
                            @if($order->status == 'pending')
                                <form method="POST" action="/admin/orders/{{ $order->id }}/status" style="display:flex; gap:8px;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="waiting_payment">
                                    <button type="submit" class="btn btn-sm rounded-pill px-3 text-white" style="background-color: #CB2957;">
                                        ✅ Terima
                                    </button>
                                </form>
                                <form method="POST" action="/admin/orders/{{ $order->id }}/status" style="display:flex; gap:8px; margin-top:5px;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm rounded-pill px-3 text-white" style="background-color: #333;">
                                        ❌ Tolak
                                    </button>
                                </form>
                            @elseif($order->status == 'in_progress')
                                <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-sm rounded-pill px-3 text-white" style="background-color: #CB2957;">
                                        🎨 Selesai
                                    </button>
                                </form>
                            @elseif($order->status == 'cancelled' || $order->status == 'rejected' || $order->status == 'completed')
                                <span style="opacity:0.4; font-size:0.85rem;">
                                    {{ $order->status == 'cancelled' ? '❌ Dibatalkan customer' : ($order->status == 'rejected' ? '❌ Ditolak' : '✅ Selesai') }}
                                </span>
                            @else
                                <span style="opacity:0.4; font-size:0.85rem;">{{ $order->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
