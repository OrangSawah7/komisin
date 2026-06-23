@extends('layouts.dashboard')

@section('title', 'Detail Order')

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

    @if(session('success'))
        <div style="background:#D1FAE5; border:1px solid #6EE7B7; border-radius:12px; padding:12px 16px; margin-bottom:24px; font-size:0.875rem; color:#065F46; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="anim-fadeup delay-1" style="display: flex; align-items: center; gap: 14px; margin-bottom: 28px;">
        <a href="/customer/orders" style="width: 36px; height: 36px; border-radius: 50%; background: white; border: 1px solid var(--cream-dark); display: flex; align-items: center; justify-content: center; color: var(--navy); text-decoration: none; transition: all 0.2s ease;"
           onmouseover="this.style.background='var(--navy)'; this.style.color='var(--cream)'"
           onmouseout="this.style.background='white'; this.style.color='var(--navy)'">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 2px;">Order #{{ $order->id }}</div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0; font-size: 1.4rem;">Detail Order</h5>
        </div>
    </div>

    <div class="row g-4">
        {{-- Kolom kiri --}}
        <div class="col-lg-8">
            <div class="form-card anim-fadeup delay-2" style="margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--cream-dark);">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-receipt" style="color: var(--navy); font-size: 0.9rem;"></i>
                        </div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Informasi Order</div>
                    </div>
                    <span class="status-badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Komisi</div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">{{ $order->commission->title }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Total</div>
                        <div style="font-weight: 700; color: var(--navy); font-size: 1.1rem;">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Tanggal Order</div>
                        <div style="font-weight: 500; color: var(--navy); font-size: 0.9rem;">{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="col-12">
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Catatanmu</div>
                        <div style="background: var(--cream); border-radius: 12px; padding: 14px 16px; font-size: 0.875rem; color: var(--navy); line-height: 1.6;">
                            {{ $order->note ?? 'Tidak ada catatan.' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Foto Referensi --}}
            <div class="form-card anim-fadeup delay-3">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--cream-dark);">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-image" style="color: var(--navy); font-size: 0.9rem;"></i>
                    </div>
                    <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Foto Referensi</div>
                </div>
                @if($order->reference_image)
                    <img src="{{ Storage::url($order->reference_image) }}"
                         style="width:100%; max-height: 360px; object-fit:cover; border-radius: 12px;">
                @else
                    <div style="background: var(--cream); border-radius: 12px; padding: 40px; text-align: center;">
                        <i class="bi bi-image" style="font-size: 1.8rem; color: var(--blue-light); opacity: 0.5;"></i>
                        <p style="color: var(--blue-light); font-size: 0.85rem; margin: 8px 0 0;">Kamu belum melampirkan foto referensi.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Kolom kanan: aksi --}}
        <div class="col-lg-4">
            @if($order->status == 'pending')
                <div class="form-card anim-fadeup delay-4">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-hourglass-split" style="color: var(--navy); font-size: 0.9rem;"></i>
                        </div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Menunggu Konfirmasi</div>
                    </div>
                    <p style="font-size: 0.85rem; color: var(--blue-light); margin-bottom: 18px; line-height: 1.6;">
                        Order kamu sedang ditinjau oleh admin. Order masih bisa dibatalkan selama belum diproses.
                    </p>
                    <form method="POST" action="/customer/orders/{{ $order->id }}/cancel">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-outline-navy w-100" style="justify-content: center; padding: 12px;"
                                onclick="return confirm('Yakin mau batalkan order ini?')">
                            <i class="bi bi-x-circle"></i> Batalkan Order
                        </button>
                    </form>
                </div>
            @elseif($order->status == 'waiting_payment')
                <div class="form-card anim-fadeup delay-4">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-credit-card" style="color: var(--navy); font-size: 0.9rem;"></i>
                        </div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Selesaikan Pembayaran</div>
                    </div>
                    <p style="font-size: 0.85rem; color: var(--blue-light); margin-bottom: 18px; line-height: 1.6;">
                        Order kamu telah diterima admin. Selesaikan pembayaran agar bisa segera dikerjakan.
                    </p>
                    <button onclick="payNow({{ $order->id }})" class="btn-navy w-100" style="justify-content: center; padding: 12px;">
                        <i class="bi bi-credit-card"></i> Bayar Sekarang
                    </button>
                </div>
            @elseif($order->status == 'in_progress')
                <div class="form-card anim-fadeup delay-4" style="text-align: center;">
                    <i class="bi bi-palette" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                    <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0; line-height: 1.6;">
                        Karyamu sedang dikerjakan. Kami akan memberitahumu setelah selesai.
                    </p>
                </div>
            @else
                <div class="form-card anim-fadeup delay-4" style="text-align: center;">
                    @if($order->status == 'cancelled')
                        <i class="bi bi-dash-circle" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                        <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0;">Order ini telah dibatalkan.</p>
                    @elseif($order->status == 'rejected')
                        <i class="bi bi-x-circle" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                        <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0;">Order ini ditolak oleh admin.</p>
                    @elseif($order->status == 'completed')
                        <i class="bi bi-check-circle" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                        <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0;">Karyamu telah selesai!</p>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        function payNow(orderId) {
            fetch(`/customer/payment/${orderId}/token`, { cache: 'no-store' })
                .then(res => res.json())
                .then(data => {
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            window.location.reload();
                        },
                        onPending: function(result) {
                            window.location.reload();
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal!');
                        }
                    });
                });
        }
    </script>
@endsection
