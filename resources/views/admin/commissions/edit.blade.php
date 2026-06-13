@extends('layouts.dashboard')

@section('title', 'Edit Komisi')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link active">
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
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="/admin/commissions" style="color: #CB2957;"><i class="fas fa-arrow-left"></i></a>
        <h5 class="fw-bold mb-0">Edit Komisi</h5>
    </div>

    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        <form method="POST" action="/admin/commissions/{{ $commission->id }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" style="opacity:0.7;">Judul <span style="color:#CB2957;">*</span></label>
                <input type="text" name="title" class="form-control rounded-3"
                       style="background-color: #111; border: 1px solid #333; color: #fff;"
                       value="{{ $commission->title }}" required>
                @error('title')
                <small style="color:#CB2957;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" style="opacity:0.7;">Kategori <span style="color:#CB2957;">*</span></label>
                <input type="text" name="category" class="form-control rounded-3"
                       style="background-color: #111; border: 1px solid #333; color: #fff;"
                       value="{{ $commission->category }}" required>
                @error('category')
                <small style="color:#CB2957;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" style="opacity:0.7;">Harga <span style="color:#CB2957;">*</span></label>
                <div class="input-group">
                    <span class="input-group-text" style="background-color: #CB2957; border:0; color:#fff;">Rp</span>
                    <input type="number" name="price" class="form-control rounded-end rounded-3"
                           style="background-color: #111; border: 1px solid #333; color: #fff;"
                           value="{{ $commission->price }}" required>
                </div>
                @error('price')
                <small style="color:#CB2957;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label" style="opacity:0.7;">Deskripsi <span style="color:#CB2957;">*</span></label>
                <textarea name="description" rows="5" class="form-control rounded-3"
                          style="background-color: #111; border: 1px solid #333; color: #fff;">{{ $commission->description }}</textarea>
                @error('description')
                <small style="color:#CB2957;">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn rounded-pill px-5 text-white fw-bold" style="background-color: #CB2957;">
                    Update
                </button>
                <a href="/admin/commissions" class="btn btn-outline-light rounded-pill px-5">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
