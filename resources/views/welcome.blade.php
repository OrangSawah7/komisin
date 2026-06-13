@extends('layouts.main')

@section('content')

    {{-- kepala web AKA navbar --}}
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #000000; box-shadow: 0 2px 20px rgba(0,0,0,0.5);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/" style="font-family: 'Poppins', sans-serif; font-size: 1.5rem;">
                🎨 <span style="color: #CB2957;">Komis</span><span style="color: #fff;">in</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Browse Komisi</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="btn btn-outline-light rounded-pill px-4 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                👤 {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                                <li>
                                    <a class="dropdown-item text-white" href="/{{ auth()->user()->role }}/dashboard">
                                        <i class="fas fa-home me-2" style="color: #CB2957;"></i> Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" style="border-color: #333;"></li>
                                <li>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-white">
                                            <i class="fas fa-sign-out-alt me-2" style="color: #CB2957;"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-light rounded-pill px-4" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn rounded-pill px-4 text-white fw-bold" href="/register" style="background-color: #CB2957;">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- hero section, simple nya ini banner le --}}
    <section style="background: linear-gradient(135deg, #000000, #1a0a0f, #2d0e1e); min-height: 90vh; display: flex; align-items: center;">
        <div class="container text-white text-center py-5">
        <span class="badge rounded-pill px-4 py-2 mb-4" style="background-color: #CB2957; font-size: 0.9rem;">
            Platform Komisi Digital #1
        </span>
            <h1 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif; font-size: 3.5rem;">
                Temukan Artist <br><span style="color: #CB2957;">Impianmu</span>
            </h1>
            <p class="lead mb-5" style="opacity: 0.7; font-size: 1.2rem;">
                Pesan ilustrasi, desain, dan karya seni dari artist berbakat Indonesia
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="#komisi" class="btn btn-lg rounded-pill px-5 fw-bold text-white" style="background-color: #CB2957;">
                    Browse Komisi
                </a>
                <a href="/register" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">
                    Jadi Artist 🎨
                </a>
            </div>
        </div>
    </section>

    {{-- tempat cara kerja tp nanti di apdet lagi --}}
    <section style="background-color: #111111; padding: 80px 0;">
        <div class="container text-white text-center">
            <h2 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif;">Cara Kerja Komisiin</h2>
            <p style="opacity: 0.5; margin-bottom: 50px;">Simpel, cepat, dan aman</p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                        <div class="mb-3" style="font-size: 2.5rem;">🔍</div>
                        <h5 class="fw-bold">1. Browse Komisi</h5>
                        <p style="opacity: 0.6;">Temukan artist dan komisi yang sesuai kebutuhanmu</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                        <div class="mb-3" style="font-size: 2.5rem;">📝</div>
                        <h5 class="fw-bold">2. Buat Order</h5>
                        <p style="opacity: 0.6;">Isi brief dan detail pesananmu kepada artist</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #CB2957;">
                        <div class="mb-3" style="font-size: 2.5rem;">🎨</div>
                        <h5 class="fw-bold">3. Terima Karya</h5>
                        <p style="opacity: 0.6;">Bayar dan terima karya digitalmu dengan aman</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BROWSE KOMISI --}}
    <section id="komisi" style="background-color: #0a0a0a; padding: 80px 0;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white" style="font-family: 'Poppins', sans-serif;">Browse Komisi</h2>
                <p style="opacity: 0.5; color: #fff;">Temukan karya yang sesuai kebutuhanmu</p>
            </div>

            @if($commissions->isEmpty())
                <div class="text-center" style="color: rgba(255,255,255,0.4);">
                    <p>Belum ada komisi tersedia.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($commissions as $commission)
                        <div class="col-md-4">
                            <div class="p-4 rounded-4 h-100" style="background-color: #1a1a1a; border: 1px solid #333;">
                                <div class="mb-3 rounded-3 d-flex align-items-center justify-content-center"
                                     style="height: 150px; background-color: #CB2957; font-size: 3rem;">
                                    🎨
                                </div>
                                <span class="badge rounded-pill mb-2" style="background-color: #333; color: #fff;">
                            {{ $commission->category }}
                        </span>
                                <h6 class="fw-bold text-white mt-2">{{ $commission->title }}</h6>
                                <p style="opacity: 0.5; color: #fff; font-size: 0.85rem;">
                                    {{ Str::limit($commission->description, 80) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold" style="color: #CB2957;">
                                Rp {{ number_format($commission->price, 0, ',', '.') }}
                            </span>
                                    @auth <!-- ini kalo udah login -->
                                        <!-- kalau udah login/role nya cust, bakal nampilin tombol order -->
                                        @if(auth()->user()->role === 'customer')
                                            <a href="/customer/orders/{{ $commission->id }}/create"
                                               class="btn btn-sm rounded-pill px-3 text-white"
                                               style="background-color: #CB2957;">
                                                Order Sekarang
                                            </a>
                                        @endif
                                    @else <!-- kalau belum login, tombol diarahkan ke login dulu -->
                                        <a href="/login"
                                           class="btn btn-sm rounded-pill px-3 text-white"
                                           style="background-color: #CB2957;">
                                            Order Sekarang
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- kaki web --}}
    <footer style="background-color: #000000; padding: 30px 0; border-top: 1px solid #CB2957;">
        <div class="container text-center" style="color: rgba(255,255,255,0.4);">
            <p class="mb-0">© 2026 🎨 Komisiin — Platform Komisi Karya Digital</p>
        </div>
    </footer>

@endsection
