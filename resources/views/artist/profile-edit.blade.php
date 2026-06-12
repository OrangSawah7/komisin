@extends('layouts.dashboard')

@section('title', 'Edit Profil')

@section('sidebar-menu')
    <a href="/artist/dashboard" class="nav-link">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="/artist/profile" class="nav-link">
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
    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        <h5 class="fw-bold mb-4">Edit Profil</h5>

        <form method="POST" action="/artist/profile/update">
            @csrf

            <div class="mb-3">
                <label class="form-label" style="opacity:0.7;">Display Name <span style="color:#CB2957;">*</span></label>
                <input type="text" name="display_name" class="form-control rounded-3"
                       style="background-color: #111; border: 1px solid #333; color: #fff;"
                       value="{{ $profile->display_name ?? '' }}" required>
                @error('display_name')
                <small style="color:#CB2957;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" style="opacity:0.7;">Bio</label>
                <textarea name="bio" rows="4" class="form-control rounded-3"
                          style="background-color: #111; border: 1px solid #333; color: #fff;">{{ $profile->bio ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" style="opacity:0.7;">Instagram</label>
                <div class="input-group">
                    <span class="input-group-text" style="background-color: #CB2957; border:0; color:#fff;">@</span>
                    <input type="text" name="instagram" class="form-control rounded-end rounded-3"
                           style="background-color: #111; border: 1px solid #333; color: #fff;"
                           value="{{ $profile->instagram ?? '' }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label" style="opacity:0.7;">Twitter</label>
                <div class="input-group">
                    <span class="input-group-text" style="background-color: #CB2957; border:0; color:#fff;">@</span>
                    <input type="text" name="twitter" class="form-control rounded-end rounded-3"
                           style="background-color: #111; border: 1px solid #333; color: #fff;"
                           value="{{ $profile->twitter ?? '' }}">
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn rounded-pill px-5 text-white fw-bold" style="background-color: #CB2957;">
                    Simpan
                </button>
                <a href="/artist/profile" class="btn btn-outline-light rounded-pill px-5">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
