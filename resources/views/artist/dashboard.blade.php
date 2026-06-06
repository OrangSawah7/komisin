@extends('layouts.dashboard')

@section('title', 'Artist Dashboard')

@section('sidebar-menu')
    <a href="/artist/dashboard" class="nav-link active">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="#" class="nav-link">
        <i class="fas fa-paint-brush"></i> Komisi Saya
    </a>
    <a href="#" class="nav-link">
        <i class="fas fa-box"></i> Order Masuk
    </a>
@endsection

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">🎨</div>
                <h6 class="mt-2" style="opacity: 0.6;">Komisi Aktif</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">📦</div>
                <h6 class="mt-2" style="opacity: 0.6;">Order Masuk</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">✅</div>
                <h6 class="mt-2" style="opacity: 0.6;">Order Selesai</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        <h5 class="fw-bold mb-3">Order Terbaru</h5>
        <p style="opacity: 0.5;">Belum ada order masuk.</p>
    </div>
@endsection
