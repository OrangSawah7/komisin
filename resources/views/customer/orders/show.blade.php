@extends('layouts.dashboard')

@section('title', 'Detail Order')

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
    @if(session('success'))
        <div class="alert rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #CB2957; color: #fff;">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="/customer/orders" style="color: #CB2957;"><i class="fas fa-arrow-left"></i></a>
        <h5 class="fw-bold mb-0">Detail Order</h5>
    </div>

    <div class="p-4 rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        <table class="table table-borderless" style="color: #fff;">
            <tr>
                <td style="opacity:0.5; width:150px;">Komisi</td>
                <td class="fw-bold">{{ $order->commission->title }}</td>
            </tr>
            <tr>
                <td style="opacity:0.5;">Total</td>
                <td class="fw-bold" style="color: #CB2957;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="opacity:0.5;">Status</td>
                <td>
                    <span class="badge rounded-pill" style="background-color: #CB2957;">
                        {{ $order->status }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="opacity:0.5;">Catatan</td>
                <td>{{ $order->note ?? '-' }}</td>
            </tr>
            <tr>
                <td style="opacity:0.5;">Tanggal</td>
                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
            </tr>
        </table>
    </div>

    <!-- tombol cancel -->
    @if($order->status == 'pending')
        <div class="p-4 rounded-4 mt-3" style="background-color: #1a1a1a; border: 1px solid #333;">
            <h6 class="fw-bold mb-1">Batalkan Order</h6>
            <p style="opacity:0.6; font-size:0.9rem;">Order masih bisa dibatalkan karena belum diproses.</p>
            <form method="POST" action="/customer/orders/{{ $order->id }}/cancel">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn rounded-pill px-5 text-white fw-bold"
                        style="background-color: #333; border: 1px solid #CB2957;"
                        onclick="return confirm('Yakin mau batalkan order ini?')">
                    Batalkan Order ❌
                </button>
            </form>
        </div>
    @endif

    {{-- Tombol Bayar --}}
    @if($order->status == 'waiting_payment')
        <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
            <h6 class="fw-bold mb-1">Selesaikan Pembayaran</h6>
            <p style="opacity:0.6; font-size:0.9rem;">Order kamu belum dibayar. Selesaikan pembayaran sekarang!</p>
            <button class="btn rounded-pill px-5 text-white fw-bold" style="background-color: #CB2957;">
                Bayar Sekarang 💳
            </button>
        </div>
    @endif
@endsection
