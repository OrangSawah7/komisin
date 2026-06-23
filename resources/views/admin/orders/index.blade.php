@extends('layouts.dashboard')

@section('title', 'Kelola Order')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link">
        <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link">
        <i class="bi bi-palette"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link active">
        <i class="bi bi-box"></i> Kelola Order
    </a>
    <a href="/admin/users" class="nav-link">
        <i class="bi bi-people"></i> Kelola User
    </a>
@endsection

@section('content')

    @if(session('success'))
        <div style="background:#D1FAE5; border:1px solid #6EE7B7; border-radius:12px; padding:12px 16px; margin-bottom:24px; font-size:0.875rem; color:#065F46; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="anim-fadeup delay-1" style="margin-bottom: 24px;">
        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Manajemen</div>
        <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0;">Kelola Order</h5>
    </div>

    @if($orders->isEmpty())
        <div class="anim-fadeup delay-2" style="background: white; border-radius: 20px; border: 1px solid var(--cream-dark); padding: 80px 40px; text-align: center;">
            <div style="width: 80px; height: 80px; background: var(--cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i class="bi bi-inbox" style="font-size: 2rem; color: var(--blue-light);"></i>
            </div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin-bottom: 8px;">Belum ada order</h5>
            <p style="color: var(--blue-light); font-size: 0.9rem; margin: 0;">Order dari customer akan muncul di sini.</p>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 12px;">
            @foreach($orders as $order)
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
                <div class="anim-fadeup delay-1" style="background: white; border-radius: 16px; border: 1px solid var(--cream-dark); padding: 20px 24px; transition: all 0.2s ease;"
                     onmouseover="this.style.boxShadow='0 8px 30px rgba(17,24,68,0.08)'"
                     onmouseout="this.style.boxShadow='none'">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
                        <div style="flex: 1;">
                            <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                                Order #{{ $order->id }} · {{ $order->created_at->format('d M Y') }}
                            </div>
                            <h6 style="font-family: 'Playfair Display', serif; color: var(--navy); margin-bottom: 4px; font-size: 1rem;">
                                {{ $order->commission->title }}
                            </h6>
                            <div style="font-size: 0.85rem; color: var(--blue-light); display: flex; align-items: center; gap: 6px;">
                                <i class="bi bi-person"></i> {{ $order->customer->name }}
                            </div>
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            <div style="font-size: 1.1rem; font-weight: 700; color: var(--navy); margin-bottom: 8px;">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </div>
                            <span class="status-badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                        </div>
                    </div>

                    <div style="border-top: 1px solid var(--cream); margin-top: 16px; padding-top: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            @if($order->status == 'pending')
                                <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="waiting_payment">
                                    <button type="submit" class="btn-navy" style="padding: 8px 16px; font-size: 0.8rem;">
                                        <i class="bi bi-check2"></i> Terima
                                    </button>
                                </form>
                                <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn-danger-custom" style="padding: 8px 16px; font-size: 0.8rem; border-radius: 10px;">
                                        <i class="bi bi-x"></i> Tolak
                                    </button>
                                </form>
                            @elseif($order->status == 'in_progress')
                                <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn-navy" style="padding: 8px 16px; font-size: 0.8rem;">
                                        <i class="bi bi-check2-circle"></i> Tandai Selesai
                                    </button>
                                </form>
                            @else
                                <div style="font-size: 0.8rem; color: var(--blue-light); display: flex; align-items: center; gap: 6px;">
                                    @if($order->status == 'cancelled')
                                        <i class="bi bi-dash-circle"></i> Dibatalkan oleh customer
                                    @elseif($order->status == 'rejected')
                                        <i class="bi bi-x-circle"></i> Order ditolak
                                    @elseif($order->status == 'completed')
                                        <i class="bi bi-check-circle"></i> Order selesai
                                    @elseif($order->status == 'waiting_payment')
                                        <i class="bi bi-clock"></i> Menunggu pembayaran customer
                                    @endif
                                </div>
                            @endif
                        </div>
                        <a href="/admin/orders/{{ $order->id }}" class="btn-outline-navy" style="padding: 8px 16px; font-size: 0.8rem;">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
