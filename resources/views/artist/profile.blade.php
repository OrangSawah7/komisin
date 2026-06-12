@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('sidebar-menu')
    <a href="/artist/dashboard" class="nav-link">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="/artist/profile" class="nav-link active">
        <i class="fas fa-user"></i> Profil Saya
    </a>
    <a href="#" class="nav-link">
        <i class="fas fa-paint-brush"></i> Komisi Saya
    </a>
    <a href="#" class="nav-link">
        <i class="fas fa-box"></i> Order Masuk
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #CB2957; color: #fff;">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-4 rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Profil Saya</h5>
            <a href="/artist/profile/edit" class="btn btn-sm rounded-pill px-4 text-white" style="background-color: #CB2957;">
                <i class="fas fa-edit me-1"></i> Edit Profil
            </a>
        </div>

        @if($profile)
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center" style="width:100px; height:100px; background-color: #CB2957; font-size: 2.5rem;">
                        🎨
                    </div>
                    <h6 class="fw-bold">{{ $profile->display_name }}</h6>
                </div>
                <div class="col-md-9">
                    <table class="table table-borderless" style="color: #fff;">
                        <tr>
                            <td style="opacity:0.5; width:150px;">Bio</td>
                            <td>{{ $profile->bio ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="opacity:0.5;">Instagram</td>
                            <td>{{ $profile->instagram ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="opacity:0.5;">Twitter</td>
                            <td>{{ $profile->twitter ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @else
            <p style="opacity:0.5;">Profil belum diisi. <a href="/artist/profile/edit" style="color: #CB2957;">Lengkapi sekarang!</a></p>
        @endif
    </div>
@endsection
