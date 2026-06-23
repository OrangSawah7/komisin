@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('sidebar-menu')
    <a href="/customer/profile" class="nav-link active">
        <i class="bi bi-person"></i> Profil Saya
    </a>
    <a href="/" class="nav-link">
        <i class="bi bi-grid-3x3-gap"></i> Browse Komisi
    </a>
    <a href="/customer/orders" class="nav-link">
        <i class="bi bi-box"></i> Order Saya
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="anim-fadeup delay-1" style="background-color: #D1FAE5; border: 1px solid #6EE7B7; border-radius: 12px; padding: 12px 16px; margin-bottom: 24px; font-size: 0.875rem; color: #065F46;">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        {{-- Kartu Profil --}}
        <div class="col-md-4">
            <div class="form-card anim-fadeup delay-1 text-center">
                {{-- Avatar --}}
                <div style="position: relative; display: inline-block; margin-bottom: 16px;">
                    @if(auth()->user()->avatar)
                        <img src="{{ Storage::url(auth()->user()->avatar) }}"
                             style="width:100px; height:100px; border-radius:50%; object-fit:cover; border: 3px solid var(--cream-dark);">
                    @else
                        <div style="width:100px; height:100px; border-radius:50%; background-color: var(--navy); color: var(--cream); display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-family:'Playfair Display',serif; margin: 0 auto;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin-bottom: 4px;">{{ auth()->user()->name }}</h5>
                <div style="font-size: 0.8rem; color: var(--blue-light); margin-bottom: 12px;">Customer</div>
                @if(auth()->user()->bio)
                    <p style="font-size: 0.875rem; color: var(--blue); line-height: 1.6;">{{ auth()->user()->bio }}</p>
                @else
                    <p style="font-size: 0.875rem; color: var(--blue-light); opacity: 0.6;">Belum ada bio.</p>
                @endif
            </div>
        </div>

        {{-- Form Edit Profil --}}
        <div class="col-md-8">
            <div class="form-card anim-fadeup delay-2">
                <h6 style="font-weight: 600; color: var(--navy); margin-bottom: 24px;">Edit Profil</h6>

                <form method="POST" action="/customer/profile" enctype="multipart/form-data">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label class="form-label-custom">Nama</label>
                        <input type="text" name="name" class="form-input-custom"
                               value="{{ auth()->user()->name }}" required>
                        @error('name')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label class="form-label-custom">Bio</label>
                        <textarea name="bio" class="form-input-custom" rows="3"
                                  placeholder="Ceritakan sedikit tentang dirimu...">{{ auth()->user()->bio }}</textarea>
                        @error('bio')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                    </div>

                    <div style="margin-bottom: 28px;">
                        <label class="form-label-custom">Foto Profil</label>
                        <input type="file" name="avatar" class="form-input-custom"
                               accept="image/jpg,image/jpeg,image/png">
                        <div style="font-size: 0.75rem; color: var(--blue-light); margin-top: 6px;">Format: JPG, PNG. Maks 2MB.</div>
                        @error('avatar')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn-navy">
                        <i class="bi bi-check2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- Riwayat Order --}}
        <div class="col-12 anim-fadeup delay-3">
            <div class="table-custom">
                <div style="padding: 20px 24px; border-bottom: 1px solid var(--cream-dark); display: flex; justify-content: space-between; align-items: center;">
                    <h6 style="font-weight: 600; color: var(--navy); margin: 0;">Riwayat Order</h6>
                    <a href="/customer/orders" style="font-size: 0.8rem; color: var(--blue); text-decoration: none;">
                        Lihat semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                @if($orders->isEmpty())
                    <div style="padding: 40px; text-align: center;">
                        <i class="bi bi-box" style="font-size: 2rem; color: var(--blue-light); opacity: 0.4;"></i>
                        <p style="color: var(--blue-light); margin-top: 12px; font-size: 0.875rem;">Belum ada order. <a href="/" style="color: var(--navy);">Browse komisi sekarang!</a></p>
                    </div>
                @else
                    <table style="width:100%; border-collapse: collapse;">
                        <thead>
                        <tr style="border-bottom: 1px solid var(--cream-dark);">
                            <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Komisi</th>
                            <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Total</th>
                            <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Status</th>
                            <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Tanggal</th>
                            <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr style="border-bottom: 1px solid var(--cream);">
                                <td style="padding: 14px 20px; font-size: 0.875rem; color: var(--navy); font-weight: 500;">{{ $order->commission->title }}</td>
                                <td style="padding: 14px 20px; font-size: 0.875rem; color: var(--navy); font-weight: 600;">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td style="padding: 14px 20px;">
                                    <span class="status-badge status-{{ $order->status == 'waiting_payment' ? 'waiting' : $order->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td style="padding: 14px 20px; font-size: 0.875rem; color: var(--blue-light);">{{ $order->created_at->format('d M Y') }}</td>
                                <td style="padding: 14px 20px;">
                                    <a href="/customer/orders/{{ $order->id }}" class="btn-outline-navy" style="padding: 6px 14px; font-size: 0.8rem;">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
