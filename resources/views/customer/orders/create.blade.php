@extends('layouts.dashboard')

@section('title', 'Buat Order')

@section('sidebar-menu')
    <a href="/customer/dashboard" class="nav-link">
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
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="/" style="color: #CB2957;"><i class="fas fa-arrow-left"></i></a>
        <h5 class="fw-bold mb-0">Buat Order</h5>
    </div>

    {{-- Detail Komisi --}}
    <div class="p-4 rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
        <h6 class="fw-bold" style="color: #CB2957;">{{ $commission->title }}</h6>
        <p style="opacity:0.6; font-size:0.9rem;">{{ $commission->description }}</p>
        <span class="fw-bold" style="color: #CB2957;">Rp {{ number_format($commission->price, 0, ',', '.') }}</span>
    </div>

    {{-- Form Order --}}
    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        <form method="POST" action="/customer/orders/{{ $commission->id }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="form-label" style="opacity:0.7;">Catatan / Brief <span style="opacity:0.5;">(opsional)</span></label>
                <textarea name="note" rows="5" class="form-control rounded-3"
                          style="background-color: #111; border: 1px solid #333; color: #fff;"
                          placeholder="Ceritakan detail yang kamu inginkan...">{{ old('note') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label" style="opacity:0.7;">Foto Referensi <span style="opacity:0.5;">(opsional)</span></label>
                <input type="file" name="reference_image" class="form-control rounded-3"
                       style="background-color: #111; border: 1px solid #333; color: #fff;"
                       accept="image/jpg,image/jpeg,image/png">
                <small style="opacity:0.4;">Upload gambar referensi untuk memperjelas pesananmu. Format: JPG, JPEG, PNG. Maks 2MB.</small>
                @error('reference_image')
                <small style="color:#CB2957;">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn rounded-pill px-5 text-white fw-bold" style="background-color: #CB2957;">
                    Order Sekarang 🎨
                </button>
                <a href="/" class="btn btn-outline-light rounded-pill px-5">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
