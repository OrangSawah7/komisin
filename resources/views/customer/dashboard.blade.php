@extends('layouts.dashboard')

@section('title', 'Customer Dashboard')

@section('sidebar-menu')
    <a href="/customer/dashboard" class="nav-link active">
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
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">📦</div>
                <h6 class="mt-2" style="opacity: 0.6;">Total Order</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">⏳</div>
                <h6 class="mt-2" style="opacity: 0.6;">Order Berjalan</h6>
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
        <p style="opacity: 0.5;">Belum ada order. <a href="#" style="color: #CB2957;">Browse komisi sekarang!</a></p>
    </div>
@endsection
