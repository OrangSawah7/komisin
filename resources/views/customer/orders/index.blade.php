@extends('layouts.dashboard')

@section('title', 'Order Saya')

@section('sidebar-menu')
    <a href="/customer/profile" class="nav-link">
        <i class="bi bi-person"></i> Profil Saya
    </a>
    <a href="/" class="nav-link">
        <i class="bi bi-grid-3x3-gap"></i> Browse Komisi
    </a>
    <a href="/customer/orders" class="nav-link active">
        <i class="bi bi-box"></i> Order Saya
    </a>
@endsection

@section('content')

    @if(session('success'))
        <div style="background:#D1FAE5; border:1px solid #6EE7B7; border-radius:12px; padding:12px 16px; margin-bottom:24px; font-size:0.875rem; color:#065F46; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="anim-fadeup delay-1" style="margin-bottom: 24px;">
        <a href="/" class="btn-navy" style="font-size: 0.875rem;">
            <i class="bi bi-plus"></i> Buat Order Baru
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="anim-fadeup delay-2" style="background: white; border-radius: 20px; border: 1px solid var(--cream-dark); padding: 80px 40px; text-align: center;">
            <div style="width: 80px; height: 80px; background: var(--cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i class="bi bi-box" style="font-size: 2rem; color: var(--blue-light);"></i>
            </div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin-bottom: 8px;">Belum ada order</h5>
            <p style="color: var(--blue-light); font-size: 0.9rem; margin-bottom: 24px;">Yuk mulai pesan karya impianmu!</p>
            <a href="/" class="btn-navy">
                <i class="bi bi-grid-3x3-gap"></i> Browse Komisi
            </a>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 16px;">
            @foreach($orders as $order)
                <div class="anim-fadeup delay-{{ $loop->iteration < 4 ? $loop->iteration : 4 }}"
                     style="background: white; border-radius: 16px; border: 1px solid var(--cream-dark); padding: 24px; transition: all 0.2s ease;"
                     onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(17,24,68,0.08)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 12px;">
                        <div style="flex: 1;">
                            <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                                Order #{{ $order->id }} · {{ $order->created_at->format('d M Y') }}
                            </div>
                            <h6 style="font-family: 'Playfair Display', serif; color: var(--navy); font-size: 1.05rem; margin-bottom: 6px;">
                                {{ $order->commission->title }}
                            </h6>
                            @if($order->note)
                                <p style="font-size: 0.8rem; color: var(--blue-light); margin: 0; line-height: 1.5;">
                                    "{{ Str::limit($order->note, 80) }}"
                                </p>
                            @endif
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            <div style="font-size: 1.1rem; font-weight: 700; color: var(--navy); margin-bottom: 8px;">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </div>
                            @php
                                $statusMap = [
                                    'pending' => ['label' => 'Menunggu Konfirmasi', 'class' => 'status-pending'],
                                    'waiting_payment' => ['label' => 'Menunggu Pembayaran', 'class' => 'status-waiting'],
                                    'in_progress' => ['label' => 'Sedang Dikerjakan', 'class' => 'status-progress'],
                                    'completed' => ['label' => 'Selesai', 'class' => 'status-completed'],
                                    'rejected' => ['label' => 'Ditolak', 'class' => 'status-rejected'],
                                    'cancelled' => ['label' => 'Dibatalkan', 'class' => 'status-cancelled'],
                                ];
                                $s = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'status-pending'];
                            @endphp
                            <span class="status-badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                        </div>
                    </div>

                    <div style="border-top: 1px solid var(--cream); margin-top: 16px; padding-top: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                        <div style="font-size: 0.8rem; color: var(--blue-light); display: flex; align-items: center; gap: 6px;">
                            @if($order->status == 'pending')
                                <i class="bi bi-clock"></i> Menunggu admin memproses ordermu
                            @elseif($order->status == 'waiting_payment')
                                <i class="bi bi-credit-card"></i> Silakan selesaikan pembayaran
                            @elseif($order->status == 'in_progress')
                                <i class="bi bi-palette"></i> Admin sedang mengerjakan pesananmu
                            @elseif($order->status == 'completed')
                                <i class="bi bi-check-circle"></i> Pesanan telah selesai
                            @elseif($order->status == 'rejected')
                                <i class="bi bi-x-circle"></i> Pesanan ditolak oleh admin
                            @elseif($order->status == 'cancelled')
                                <i class="bi bi-dash-circle"></i> Pesanan dibatalkan
                            @endif
                        </div>
                        <a href="/customer/orders/{{ $order->id }}" class="btn-outline-navy" style="padding: 8px 20px; font-size: 0.8rem;">
                            Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
