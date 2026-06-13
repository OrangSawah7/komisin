@extends('layouts.dashboard')

@section('title', 'Detail Order')

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
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="/admin/orders" style="color: #CB2957;"><i class="fas fa-arrow-left"></i></a>
        <h5 class="fw-bold mb-0">Detail Order</h5>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
                <h6 class="fw-bold mb-3" style="color: #CB2957;">Info Order</h6>
                <table class="table table-borderless" style="color: #fff;">
                    <tr>
                        <td style="opacity:0.5; width:150px;">Customer</td>
                        <td class="fw-bold">{{ $order->customer->name }}</td>
                    </tr>
                    <tr>
                        <td style="opacity:0.5;">Email</td>
                        <td>{{ $order->customer->email }}</td>
                    </tr>
                    <tr>
                        <td style="opacity:0.5;">Komisi</td>
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
        </div>

        <div class="col-md-4">
            {{-- Foto Referensi --}}
            <div class="p-4 rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #333;">
                <h6 class="fw-bold mb-3" style="color: #CB2957;">Foto Referensi</h6>
                @if($order->reference_image)
                    <img src="{{ Storage::url($order->reference_image) }}"
                         class="w-100 rounded-3"
                         style="object-fit:cover;">
                @else
                    <p style="opacity:0.4;">Tidak ada foto referensi.</p>
                @endif
            </div>

            {{-- Aksi --}}
            @if($order->status == 'pending')
                <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                    <h6 class="fw-bold mb-3">Tindakan</h6>
                    <form method="POST" action="/admin/orders/{{ $order->id }}/status" class="mb-2">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="waiting_payment">
                        <button type="submit" class="btn rounded-pill px-4 text-white w-100 fw-bold" style="background-color: #CB2957;">
                            ✅ Terima Order
                        </button>
                    </form>
                    <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn rounded-pill px-4 text-white w-100" style="background-color: #333; border: 1px solid #CB2957;">
                            ❌ Tolak Order
                        </button>
                    </form>
                </div>
            @elseif($order->status == 'in_progress')
                <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                    <h6 class="fw-bold mb-3">Tindakan</h6>
                    <form method="POST" action="/admin/orders/{{ $order->id }}/status">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn rounded-pill px-4 text-white w-100 fw-bold" style="background-color: #CB2957;">
                            🎨 Tandai Selesai
                        </button>
                    </form>
                </div>
            @else
                <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
                    <p style="opacity:0.4; margin:0;">
                        {{ $order->status == 'cancelled' ? '❌ Dibatalkan customer' : ($order->status == 'rejected' ? '❌ Ditolak' : ($order->status == 'completed' ? '✅ Selesai' : $order->status)) }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
