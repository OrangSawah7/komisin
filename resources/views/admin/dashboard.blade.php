@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link active">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link">
        <i class="fas fa-paint-brush"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link">
        <i class="fas fa-box"></i> Kelola Order
    </a>
    <a href="/admin/users" class="nav-link">
        <i class="fas fa-users"></i> Kelola User
    </a>
@endsection

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">👥</div>
                <h6 class="mt-2" style="opacity: 0.6;">Total User</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">🎨</div>
                <h6 class="mt-2" style="opacity: 0.6;">Total Komisi</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                <div style="color: #CB2957; font-size: 2rem;">📦</div>
                <h6 class="mt-2" style="opacity: 0.6;">Total Order</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        <h5 class="fw-bold mb-3">Komisi Pending Approval</h5>
        <p style="opacity: 0.5;">Belum ada komisi yang menunggu approval.</p>
    </div>
@endsection
