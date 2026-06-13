@extends('layouts.dashboard')

@section('title', 'Order Saya')

@section('sidebar-menu')
    <a href="/customer/dashboard" class="nav-link">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="/" class="nav-link">
        <i class="fas fa-search"></i> Browse Komisi
    </a>
    <a href="/customer/orders" class="nav-link">
        <i class="fas fa-box"></i> Order Saya
    </a>
@endsection

@section('content')
    <h5 class="fw-bold mb-4">Order Saya</h5>

    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        @if($orders->isEmpty())
            <p style="opacity:0.5;">Belum ada order. <a href="/" style="color: #CB2957;">Browse komisi sekarang!</a></p>
        @else
            <table class="table table-borderless" style="color: #fff;">
                <thead>
                <tr style="border-bottom: 1px solid #333;">
                    <th style="opacity:0.5;">#</th>
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
                        <td>{{ $order->commission->title }}</td>
                        <td style="color: #CB2957;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge rounded-pill" style="background-color: #CB2957;">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/customer/orders/{{ $order->id }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">Detail</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
