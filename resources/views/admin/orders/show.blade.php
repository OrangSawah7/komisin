@extends('layouts.dashboard')

@section('title', 'Detail Order')

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

    <div class="anim-fadeup delay-1" style="display: flex; align-items: center; gap: 14px; margin-bottom: 28px;">
        <a href="/admin/orders" style="width: 36px; height: 36px; border-radius: 50%; background: white; border: 1px solid var(--cream-dark); display: flex; align-items: center; justify-content: center; color: var(--navy); text-decoration: none; transition: all 0.2s ease;"
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
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Customer</div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 38px; height: 38px; border-radius: 50%; background: var(--navy); color: var(--cream); display: flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 700; font-family: 'Playfair Display', serif;">
                                {{ strtoupper(substr($order->customer->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight: 600; color: var(--navy); font-size: 0.9rem;">{{ $order->customer->name }}</div>
                                <div style="font-size: 0.8rem; color: var(--blue-light);">{{ $order->customer->email }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Komisi</div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.9rem;">{{ $order->commission->title }}</div>
                        <div style="font-size: 0.8rem; color: var(--blue-light); margin-top: 2px;">{{ $order->commission->category }}</div>
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
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Catatan dari Customer</div>
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
                        <p style="color: var(--blue-light); font-size: 0.85rem; margin: 8px 0 0;">Customer tidak melampirkan foto referensi.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Kolom kanan: aksi --}}
        <div class="col-lg-4">
            <div class="form-card anim-fadeup delay-4">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--cream-dark);">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-lightning-charge" style="color: var(--navy); font-size: 0.9rem;"></i>
                    </div>
                    <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Tindakan</div>
                </div>

                @if($order->status == 'pending')
                    <p style="font-size: 0.85rem; color: var(--blue-light); margin-bottom: 18px; line-height: 1.6;">
                        Order ini menunggu konfirmasimu. Terima jika permintaan sesuai, atau tolak jika tidak memungkinkan.
                    </p>
                    <form method="POST" action="/admin/orders/{{ $order->id }}/status" style="margin-bottom: 10px;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="waiting_payment">
                        <button type="submit" class="btn-navy w-100" style="justify-content: center; padding: 12px;">
                            <i class="bi bi-check2"></i> Terima Order
                        </button>
                    </form>
                    <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn-danger-custom w-100" style="border-radius: 10px; padding: 12px; justify-content: center; display: flex; align-items: center; gap: 8px;">
                            <i class="bi bi-x"></i> Tolak Order
                        </button>
                    </form>
                @elseif($order->status == 'waiting_payment')
                    <div style="text-align: center; padding: 20px 0;">
                        <i class="bi bi-hourglass-split" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                        <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0; line-height: 1.6;">
                            Menunggu customer menyelesaikan pembayaran.
                        </p>
                    </div>
                @elseif($order->status == 'in_progress')
                    <p style="font-size: 0.85rem; color: var(--blue-light); margin-bottom: 18px; line-height: 1.6;">
                        Sudah dibayar dan sedang dikerjakan. Tandai selesai setelah karya rampung.
                    </p>
                    <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn-navy w-100" style="justify-content: center; padding: 12px;">
                            <i class="bi bi-check2-circle"></i> Tandai Selesai
                        </button>
                    </form>
                @else
                    <div style="text-align: center; padding: 20px 0;">
                        @if($order->status == 'cancelled')
                            <i class="bi bi-dash-circle" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                            <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0;">Order dibatalkan oleh customer.</p>
                        @elseif($order->status == 'rejected')
                            <i class="bi bi-x-circle" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                            <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0;">Order telah ditolak.</p>
                        @elseif($order->status == 'completed')
                            <i class="bi bi-check-circle" style="font-size: 2rem; color: var(--blue-light); opacity: 0.6;"></i>
                            <p style="font-size: 0.85rem; color: var(--blue-light); margin: 12px 0 0;">Order telah selesai.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
