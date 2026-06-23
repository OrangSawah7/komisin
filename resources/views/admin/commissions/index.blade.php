@extends('layouts.dashboard')

@section('title', 'Kelola Komisi')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link">
        <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link active">
        <i class="bi bi-palette"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link">
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

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;" class="anim-fadeup delay-1">
        <div>
            <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Katalog</div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0;">Daftar Komisi</h5>
        </div>
        <a href="/admin/commissions/create" class="btn-navy">
            <i class="bi bi-plus-lg"></i> Tambah Komisi
        </a>
    </div>

    @if($commissions->isEmpty())
        <div class="anim-fadeup delay-2" style="background: white; border-radius: 20px; border: 1px solid var(--cream-dark); padding: 80px 40px; text-align: center;">
            <div style="width: 80px; height: 80px; background: var(--cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i class="bi bi-palette" style="font-size: 2rem; color: var(--blue-light);"></i>
            </div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin-bottom: 8px;">Belum ada komisi</h5>
            <p style="color: var(--blue-light); font-size: 0.9rem; margin-bottom: 24px;">Tambahkan komisi pertamamu sekarang!</p>
            <a href="/admin/commissions/create" class="btn-navy">
                <i class="bi bi-plus-lg"></i> Tambah Komisi
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($commissions as $index => $commission)
                <div class="col-md-4 anim-fadeup delay-{{ ($index % 3) + 1 }}">
                    <div style="background: white; border-radius: 16px; border: 1px solid var(--cream-dark); overflow: hidden; transition: all 0.2s ease;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 40px rgba(17,24,68,0.08)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        @if($commission->thumbnail)
                            <img src="{{ Storage::url($commission->thumbnail) }}"
                                 style="width:100%; height:180px; object-fit:cover;">
                        @else
                            <div style="height:180px; background: linear-gradient(135deg, var(--navy), var(--blue)); display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-palette" style="font-size: 2.5rem; color: var(--cream); opacity:0.4;"></i>
                            </div>
                        @endif
                        <div style="padding: 20px;">
                        <span style="background: var(--cream); color: var(--blue); font-size: 0.7rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; letter-spacing: 0.5px;">
                            {{ $commission->category }}
                        </span>
                            <h6 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 10px 0 4px; font-size: 1rem;">{{ $commission->title }}</h6>
                            <p style="color: var(--blue-light); font-size: 0.8rem; line-height: 1.5; margin-bottom: 12px;">
                                {{ Str::limit($commission->description, 70) }}
                            </p>
                            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid var(--cream-dark);">
                                <div style="font-weight: 700; color: var(--navy); font-size: 0.95rem;">
                                    Rp {{ number_format($commission->price, 0, ',', '.') }}
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <a href="/admin/commissions/{{ $commission->id }}/edit" class="btn-outline-navy" style="padding: 6px 14px; font-size: 0.8rem;">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="/admin/commissions/{{ $commission->id }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom" style="padding: 6px 14px; font-size: 0.8rem; border-radius: 10px;"
                                                onclick="return confirm('Yakin hapus komisi ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
