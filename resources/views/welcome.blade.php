@extends('layouts.main')

@section('content')

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg sticky-top navbar-komisiin">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--navy);">
                Komisiin
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list" style="font-size: 1.5rem; color: var(--navy);"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link-custom nav-link" href="#komisi">Browse Komisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom nav-link" href="#cara-kerja">Cara Kerja</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown"
                               style="color: var(--navy); font-weight: 500; font-size: 0.9rem;">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width:34px; height:34px; background-color: var(--navy); color: var(--cream); font-size:0.8rem; font-weight:700;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 p-2" style="background-color: var(--white); border-radius: 16px; box-shadow: 0 20px 60px rgba(17,24,68,0.15); min-width: 200px;">
                                @if(auth()->user()->role === 'customer')
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2 px-3 d-flex align-items-center gap-2" href="/customer/profile"
                                           style="color: var(--navy); font-size: 0.9rem; font-weight: 500;">
                                            <i class="bi bi-person-circle" style="color: var(--blue); font-size: 1rem;"></i> Profil
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2 px-3 d-flex align-items-center gap-2" href="/customer/orders"
                                           style="color: var(--navy); font-size: 0.9rem; font-weight: 500;">
                                            <i class="bi bi-box" style="color: var(--blue); font-size: 1rem;"></i> Order Saya
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item rounded-3 py-2 px-3 d-flex align-items-center gap-2" href="/admin/dashboard"
                                           style="color: var(--navy); font-size: 0.9rem; font-weight: 500;">
                                            <i class="bi bi-grid" style="color: var(--blue); font-size: 1rem;"></i> Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider mx-2 my-1" style="border-color: var(--cream-dark);"></li>
                                <li>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded-3 py-2 px-3 d-flex align-items-center gap-2 w-100"
                                                style="color: #991B1B; font-size: 0.9rem; font-weight: 500; background: none; border: none; cursor: pointer;">
                                            <i class="bi bi-box-arrow-right" style="font-size: 1rem;"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-custom btn-sm" href="/login">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary-custom btn-sm" href="/register">Daftar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section style="background-color: var(--cream); min-height: 92vh; display: flex; align-items: center; position: relative; overflow: hidden;">

        {{-- Decorative shapes --}}
        <div class="shape-circle anim-float" style="width:400px; height:400px; background-color: var(--blue); opacity:0.08; top:-100px; right:-100px;"></div>
        <div class="shape-blob anim-float delay-3" style="width:250px; height:250px; background-color: var(--navy); opacity:0.06; bottom:-50px; left:-80px;"></div>
        <div class="shape-circle" style="width:120px; height:120px; background-color: var(--blue-light); opacity:0.15; bottom:80px; right:200px;"></div>

        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge-custom anim-fadeup delay-1">Platform Komisi Digital</span>
                    <h1 class="mt-4 mb-4 anim-fadeup delay-2" style="font-size: clamp(2.5rem, 5vw, 4rem); color: var(--navy); line-height: 1.15;">
                        Wujudkan Karya <br><em style="color: var(--blue);">Impianmu</em> <br>Bersama Kami
                    </h1>
                    <p class="mb-5 anim-fadeup delay-3" style="color: var(--text-light); font-size: 1.05rem; line-height: 1.8; max-width: 480px;">
                        Komisiin menghubungkan kamu dengan ilustrasi, desain, dan karya seni digital custom — sesuai keinginanmu, dikerjakan dengan sepenuh hati.
                    </p>
                    <div class="d-flex gap-3 flex-wrap anim-fadeup delay-4">
                        <a href="#komisi" class="btn btn-primary-custom">
                            <i class="bi bi-grid-3x3-gap me-2"></i>Browse Komisi
                        </a>
                        <a href="/register" class="btn btn-outline-custom">
                            Mulai Gratis <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-flex justify-content-center anim-fadein delay-3">
                    <div style="position: relative; width: 100%; max-width: 460px;">
                        {{-- Card dekoratif --}}
                        <div class="anim-float" style="background: var(--navy); border-radius: 24px; padding: 32px; color: var(--cream); position: relative; z-index: 2;">
                            <div style="font-size: 0.75rem; opacity: 0.6; margin-bottom: 8px; letter-spacing: 1px; text-transform: uppercase;">Featured Commission</div>
                            <div style="font-family: 'Playfair Display', serif; font-size: 1.4rem; margin-bottom: 16px;">Character Illustration</div>
                            <div style="height: 140px; background: var(--blue); border-radius: 16px; opacity: 0.4; margin-bottom: 16px;"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div style="font-size: 0.75rem; opacity: 0.6;">Harga mulai dari</div>
                                    <div style="font-size: 1.2rem; font-weight: 600;">Rp 150.000</div>
                                </div>
                                <div style="background: var(--cream); color: var(--navy); padding: 8px 20px; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">Order</div>
                            </div>
                        </div>
                        {{-- Card kecil floating --}}
                        <div class="anim-float delay-2" style="position: absolute; bottom: -20px; right: -30px; background: var(--cream-dark); border-radius: 16px; padding: 16px 20px; z-index: 3; box-shadow: 0 10px 40px rgba(17,24,68,0.15);">
                            <div style="font-size: 0.75rem; color: var(--text-light); margin-bottom: 4px;">Order selesai</div>
                            <div style="font-size: 1rem; font-weight: 700; color: var(--navy);">+128 karya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section style="background-color: var(--navy); padding: 48px 0;">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4 anim-fadeup delay-1">
                    <div style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--cream); font-weight: 700;">{{ $commissions->count() }}+</div>
                    <div style="color: var(--blue-light); font-size: 0.9rem; margin-top: 4px;">Komisi Tersedia</div>
                </div>
                <div class="col-md-4 anim-fadeup delay-2">
                    <div style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--cream); font-weight: 700;">100%</div>
                    <div style="color: var(--blue-light); font-size: 0.9rem; margin-top: 4px;">Pembayaran Aman</div>
                </div>
                <div class="col-md-4 anim-fadeup delay-3">
                    <div style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--cream); font-weight: 700;">24/7</div>
                    <div style="color: var(--blue-light); font-size: 0.9rem; margin-top: 4px;">Layanan Tersedia</div>
                </div>
            </div>
        </div>
    </section>

    {{-- BROWSE KOMISI --}}
    <section id="komisi" style="background-color: var(--cream); padding: 100px 0;">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col">
                    <div class="section-label mb-2">Katalog</div>
                    <h2 style="color: var(--navy);">Komisi Tersedia</h2>
                </div>
                <div class="col-auto">
                    <a href="#komisi" style="color: var(--blue); font-size: 0.9rem; text-decoration: none;">
                        Lihat semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            @if($commissions->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-palette" style="font-size: 3rem; color: var(--blue-light); opacity:0.4;"></i>
                    <p style="color: var(--text-light); margin-top: 1rem;">Belum ada komisi tersedia.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($commissions as $index => $commission)
                        <div class="col-md-3 anim-fadeup delay-{{ ($index % 3) + 1 }}">
                            <div class="card-komisiin h-100" style="cursor: pointer;"
                                 data-bs-toggle="modal" data-bs-target="#modal-{{ $commission->id }}">
                                @if($commission->thumbnail)
                                    <img src="{{ Storage::url($commission->thumbnail) }}"
                                         style="width:100%; height:260px; object-fit:cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center"
                                         style="height:260px; background: linear-gradient(135deg, var(--navy), var(--blue));">
                                        <i class="bi bi-palette" style="font-size: 3rem; color: var(--cream); opacity:0.5;"></i>
                                    </div>
                                @endif
                                <div class="p-3">
                                    <div style="font-size: 0.75rem; color: var(--text-light); margin-bottom: 4px;">{{ $commission->category }}</div>
                                    <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">{{ $commission->title }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal --}}
                        <div class="modal fade" id="modal-{{ $commission->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 overflow-hidden">
                                    <div class="row g-0">
                                        {{-- Gambar --}}
                                        <div class="col-md-6">
                                            @if($commission->thumbnail)
                                                <img src="{{ Storage::url($commission->thumbnail) }}"
                                                     style="width:100%; height:100%; object-fit:cover; min-height:400px;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center"
                                                     style="height:100%; min-height:400px; background: linear-gradient(135deg, var(--navy), var(--blue));">
                                                    <i class="bi bi-palette" style="font-size: 4rem; color: var(--cream); opacity:0.5;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- Detail --}}
                                        <div class="col-md-6 p-4 d-flex flex-column" style="background-color: var(--cream);">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <span style="background-color: var(--navy); color: var(--cream); font-size: 0.7rem; font-weight: 600; padding: 4px 12px; border-radius: 50px; letter-spacing: 0.5px;">
                                                    {{ $commission->category }}
                                                </span>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <h4 style="color: var(--navy); font-family: 'Playfair Display', serif; margin-bottom: 12px;">
                                                {{ $commission->title }}
                                            </h4>
                                            <p style="color: var(--text-light); font-size: 0.9rem; line-height: 1.7; flex-grow: 1;">
                                                {{ $commission->description }}
                                            </p>
                                            <div style="border-top: 1px solid var(--cream-dark); padding-top: 20px; margin-top: 20px;">
                                                <div style="font-size: 0.75rem; color: var(--text-light); margin-bottom: 4px;">Harga</div>
                                                <div style="font-size: 1.5rem; font-weight: 700; color: var(--navy); margin-bottom: 20px;">
                                                    Rp {{ number_format($commission->price, 0, ',', '.') }}
                                                </div>
                                                @auth
                                                    @if(auth()->user()->role === 'customer')
                                                        <a href="/customer/orders/{{ $commission->id }}/create"
                                                           class="btn btn-primary-custom w-100">
                                                            Order Sekarang <i class="bi bi-arrow-right ms-2"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="/login" class="btn btn-primary-custom w-100">
                                                        Masuk untuk Order <i class="bi bi-arrow-right ms-2"></i>
                                                    </a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- CARA KERJA --}}
    <section id="cara-kerja" style="background-color: var(--navy); padding: 100px 0; position: relative; overflow: hidden;">
        <div class="shape-circle" style="width:500px; height:500px; background-color: var(--blue); opacity:0.06; top:-200px; right:-200px;"></div>
        <div class="container" style="position: relative; z-index: 1;">
            <div class="text-center mb-5">
                <div class="section-label mb-2" style="color: var(--blue-light);">Proses</div>
                <h2 style="color: var(--cream);">Cara Kerja Komisiin</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4 anim-fadeup delay-1">
                    <div style="padding: 40px 32px; border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; height: 100%; transition: all 0.3s ease;"
                         onmouseover="this.style.background='rgba(75,86,148,0.2)'; this.style.borderColor='rgba(114,136,174,0.3)'"
                         onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,0.08)'">
                        <div style="width:48px; height:48px; background: var(--blue); border-radius: 12px; display:flex; align-items:center; justify-content:center; margin-bottom: 24px;">
                            <i class="bi bi-search" style="color: var(--cream); font-size: 1.2rem;"></i>
                        </div>
                        <div style="font-size: 0.75rem; color: var(--blue-light); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">Langkah 01</div>
                        <h5 style="color: var(--cream); margin-bottom: 12px;">Browse Komisi</h5>
                        <p style="color: var(--blue-light); font-size: 0.9rem; line-height: 1.7;">Temukan komisi yang sesuai kebutuhan dan budgetmu dari katalog kami.</p>
                    </div>
                </div>
                <div class="col-md-4 anim-fadeup delay-2">
                    <div style="padding: 40px 32px; border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; height: 100%; transition: all 0.3s ease;"
                         onmouseover="this.style.background='rgba(75,86,148,0.2)'; this.style.borderColor='rgba(114,136,174,0.3)'"
                         onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,0.08)'">
                        <div style="width:48px; height:48px; background: var(--blue); border-radius: 12px; display:flex; align-items:center; justify-content:center; margin-bottom: 24px;">
                            <i class="bi bi-pencil-square" style="color: var(--cream); font-size: 1.2rem;"></i>
                        </div>
                        <div style="font-size: 0.75rem; color: var(--blue-light); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">Langkah 02</div>
                        <h5 style="color: var(--cream); margin-bottom: 12px;">Buat Order</h5>
                        <p style="color: var(--blue-light); font-size: 0.9rem; line-height: 1.7;">Isi detail brief dan upload referensi. Kami akan segera memproses pesananmu.</p>
                    </div>
                </div>
                <div class="col-md-4 anim-fadeup delay-3">
                    <div style="padding: 40px 32px; border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; height: 100%; transition: all 0.3s ease;"
                         onmouseover="this.style.background='rgba(75,86,148,0.2)'; this.style.borderColor='rgba(114,136,174,0.3)'"
                         onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,0.08)'">
                        <div style="width:48px; height:48px; background: var(--blue); border-radius: 12px; display:flex; align-items:center; justify-content:center; margin-bottom: 24px;">
                            <i class="bi bi-check2-circle" style="color: var(--cream); font-size: 1.2rem;"></i>
                        </div>
                        <div style="font-size: 0.75rem; color: var(--blue-light); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">Langkah 03</div>
                        <h5 style="color: var(--cream); margin-bottom: 12px;">Terima Karya</h5>
                        <p style="color: var(--blue-light); font-size: 0.9rem; line-height: 1.7;">Bayar setelah karya selesai dikerjakan. Aman dan terpercaya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer style="background-color: var(--navy); border-top: 1px solid rgba(255,255,255,0.06); padding: 40px 0;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: var(--cream);">Komisiin</div>
                <div style="color: var(--blue-light); font-size: 0.85rem;">© 2026 Komisiin — Platform Komisi Karya Digital</div>
            </div>
        </div>
    </footer>

    {{-- ONBOARDING MODAL --}}
    @auth
        @if(!auth()->user()->onboarding_completed && auth()->user()->role === 'customer')
            <div class="modal fade" id="onboardingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 460px;">
                    <div class="modal-content border-0 overflow-hidden" style="border-radius: 24px; box-shadow: 0 40px 80px rgba(17,24,68,0.25);">

                        {{-- Step 1 --}}
                        <div id="step-1">
                            <div style="background: linear-gradient(135deg, #111844, #4B5694); padding: 36px 40px 28px; text-align: center;">
                                <div style="font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 16px;">Langkah 1 dari 3</div>
                                <div style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #EAE0CF; margin-bottom: 6px;">Hai, siapa kamu?</div>
                                <p style="color: #7288AE; font-size: 0.85rem; margin: 0;">Yuk pasang foto dan nama kamu dulu</p>
                                <div style="display: flex; justify-content: center; gap: 5px; margin-top: 20px;">
                                    <div style="width: 28px; height: 3px; border-radius: 2px; background: #EAE0CF;"></div>
                                    <div style="width: 8px; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.2);"></div>
                                    <div style="width: 8px; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.2);"></div>
                                </div>
                            </div>
                            <div style="padding: 32px 40px; background: #EAE0CF;">
                                <div style="text-align: center; margin-bottom: 28px;">
                                    <div id="avatar-preview" onclick="document.getElementById('avatar-input').click()"
                                         style="width: 90px; height: 90px; border-radius: 50%; background: #111844; color: #EAE0CF; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-family: 'Playfair Display', serif; margin: 0 auto 10px; cursor: pointer; position: relative; overflow: hidden; border: 3px solid #D9CCBA; transition: all 0.2s ease;">
                                        <span id="avatar-initial">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                        <img id="avatar-img" src="" style="display:none; width:100%; height:100%; object-fit:cover; position:absolute; top:0; left:0;">
                                        <div style="position:absolute; bottom:0; left:0; right:0; background:rgba(17,24,68,0.6); padding:5px; font-size:0.7rem; color:white; display:flex; align-items:center; justify-content:center; gap:4px;">
                                            <i class="bi bi-camera"></i>
                                        </div>
                                    </div>
                                    <input type="file" id="avatar-input" accept="image/*" style="display:none;" onchange="previewAvatar(this)">
                                    <div style="font-size: 0.75rem; color: #7288AE;">Klik foto untuk mengubah</div>
                                </div>

                                <div style="margin-bottom: 24px;">
                                    <label style="font-size: 0.7rem; font-weight: 600; color: #4B5694; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 8px;">Nama</label>
                                    <input type="text" id="ob-name" value="{{ auth()->user()->name }}" placeholder="Nama kamu"
                                           style="width:100%; padding:12px 16px; border:1.5px solid #D9CCBA; border-radius:12px; font-size:0.9rem; color:#111844; background:white; font-family:'Inter',sans-serif; outline:none; transition:all 0.2s;"
                                           onfocus="this.style.borderColor='#4B5694'; this.style.boxShadow='0 0 0 4px rgba(75,86,148,0.1)'"
                                           onblur="this.style.borderColor='#D9CCBA'; this.style.boxShadow='none'">
                                </div>

                                <button onclick="goStep(2)"
                                        style="width:100%; padding:14px; background:#111844; color:#EAE0CF; border:none; border-radius:12px; font-size:0.9rem; font-weight:500; cursor:pointer; transition:all 0.25s; font-family:'Inter',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px;"
                                        onmouseover="this.style.background='#4B5694'; this.style.transform='translateY(-2px)'"
                                        onmouseout="this.style.background='#111844'; this.style.transform='translateY(0)'">
                                    Selanjutnya <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 2 --}}
                        <div id="step-2" style="display:none;">
                            <div style="background: linear-gradient(135deg, #111844, #4B5694); padding: 36px 40px 28px; text-align: center;">
                                <div style="font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 16px;">Langkah 2 dari 3</div>
                                <div style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #EAE0CF; margin-bottom: 6px;">Ceritakan dirimu</div>
                                <p style="color: #7288AE; font-size: 0.85rem; margin: 0;">Bio singkat biar orang kenal kamu</p>
                                <div style="display: flex; justify-content: center; gap: 5px; margin-top: 20px;">
                                    <div style="width: 8px; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.2);"></div>
                                    <div style="width: 28px; height: 3px; border-radius: 2px; background: #EAE0CF;"></div>
                                    <div style="width: 8px; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.2);"></div>
                                </div>
                            </div>
                            <div style="padding: 32px 40px; background: #EAE0CF;">
                                <div style="margin-bottom: 24px;">
                                    <label style="font-size: 0.7rem; font-weight: 600; color: #4B5694; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 8px;">Bio <span style="color: #7288AE; font-weight: 400; text-transform: none; letter-spacing: 0; font-size: 0.75rem;">(opsional)</span></label>
                                    <textarea id="ob-bio" rows="4" placeholder="Contoh: Suka koleksi karya digital, hobi nulis, dan pecinta seni..."
                                              style="width:100%; padding:12px 16px; border:1.5px solid #D9CCBA; border-radius:12px; font-size:0.9rem; color:#111844; background:white; font-family:'Inter',sans-serif; outline:none; transition:all 0.2s; resize:none;"
                                              onfocus="this.style.borderColor='#4B5694'; this.style.boxShadow='0 0 0 4px rgba(75,86,148,0.1)'"
                                              onblur="this.style.borderColor='#D9CCBA'; this.style.boxShadow='none'"></textarea>
                                    <div style="font-size: 0.75rem; color: #7288AE; margin-top: 6px;">Maks 500 karakter</div>
                                </div>

                                <div style="display: flex; gap: 10px;">
                                    <button onclick="goStep(1)"
                                            style="flex:1; padding:13px; background:transparent; color:#111844; border:1.5px solid #D9CCBA; border-radius:12px; font-size:0.875rem; font-weight:500; cursor:pointer; transition:all 0.2s; font-family:'Inter',sans-serif; display:flex; align-items:center; justify-content:center; gap:6px;"
                                            onmouseover="this.style.borderColor='#111844'"
                                            onmouseout="this.style.borderColor='#D9CCBA'">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </button>
                                    <button onclick="goStep(3)"
                                            style="flex:2; padding:13px; background:#111844; color:#EAE0CF; border:none; border-radius:12px; font-size:0.875rem; font-weight:500; cursor:pointer; transition:all 0.25s; font-family:'Inter',sans-serif; display:flex; align-items:center; justify-content:center; gap:6px;"
                                            onmouseover="this.style.background='#4B5694'; this.style.transform='translateY(-2px)'"
                                            onmouseout="this.style.background='#111844'; this.style.transform='translateY(0)'">
                                        Selanjutnya <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Step 3 --}}
                        <div id="step-3" style="display:none;">
                            <div style="background: linear-gradient(135deg, #111844, #4B5694); padding: 36px 40px 28px; text-align: center;">
                                <div style="font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 16px;">Langkah 3 dari 3</div>
                                <div style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #EAE0CF; margin-bottom: 6px;">Siap untuk mulai!</div>
                                <p style="color: #7288AE; font-size: 0.85rem; margin: 0;">Ini tampilan profilmu nanti</p>
                                <div style="display: flex; justify-content: center; gap: 5px; margin-top: 20px;">
                                    <div style="width: 8px; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.2);"></div>
                                    <div style="width: 8px; height: 3px; border-radius: 2px; background: rgba(255,255,255,0.2);"></div>
                                    <div style="width: 28px; height: 3px; border-radius: 2px; background: #EAE0CF;"></div>
                                </div>
                            </div>
                            <div style="padding: 32px 40px; background: #EAE0CF; text-align: center;">
                                <div id="confirm-avatar"
                                     style="width: 80px; height: 80px; border-radius: 50%; background: #111844; color: #EAE0CF; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-family: 'Playfair Display', serif; margin: 0 auto 12px; overflow: hidden; border: 3px solid #D9CCBA;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div id="confirm-name" style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #111844; margin-bottom: 6px; font-weight: 700;"></div>
                                <div id="confirm-bio" style="font-size: 0.85rem; color: #7288AE; margin-bottom: 28px; line-height: 1.6;"></div>

                                <button onclick="submitOnboarding()" id="btn-submit"
                                        style="width:100%; padding:14px; background:#111844; color:#EAE0CF; border:none; border-radius:12px; font-size:0.9rem; font-weight:500; cursor:pointer; transition:all 0.25s; font-family:'Inter',sans-serif; display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:10px;"
                                        onmouseover="this.style.background='#4B5694'; this.style.transform='translateY(-2px)'"
                                        onmouseout="this.style.background='#111844'; this.style.transform='translateY(0)'">
                                    <i class="bi bi-check2-circle"></i> Selesai & Mulai Jelajah
                                </button>
                                <button onclick="goStep(2)"
                                        style="width:100%; padding:13px; background:transparent; color:#111844; border:1.5px solid #D9CCBA; border-radius:12px; font-size:0.875rem; font-weight:500; cursor:pointer; transition:all 0.2s; font-family:'Inter',sans-serif; display:flex; align-items:center; justify-content:center; gap:6px;"
                                        onmouseover="this.style.borderColor='#111844'"
                                        onmouseout="this.style.borderColor='#D9CCBA'">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <script>
                window.addEventListener('load', function() {
                    var modal = new bootstrap.Modal(document.getElementById('onboardingModal'));
                    modal.show();
                });

                let avatarFile = null;

                function previewAvatar(input) {
                    if (input.files && input.files[0]) {
                        avatarFile = input.files[0];
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('avatar-img').src = e.target.result;
                            document.getElementById('avatar-img').style.display = 'block';
                            document.getElementById('avatar-initial').style.display = 'none';
                            document.getElementById('confirm-avatar').innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                function goStep(step) {
                    ['step-1','step-2','step-3'].forEach(s => document.getElementById(s).style.display = 'none');
                    document.getElementById('step-' + step).style.display = 'block';
                    if (step === 3) {
                        document.getElementById('confirm-name').textContent = document.getElementById('ob-name').value || '{{ auth()->user()->name }}';
                        const bio = document.getElementById('ob-bio').value;
                        document.getElementById('confirm-bio').textContent = bio || 'Belum ada bio';
                    }
                }

                function submitOnboarding() {
                    const btn = document.getElementById('btn-submit');
                    btn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Menyimpan...';
                    btn.disabled = true;

                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('name', document.getElementById('ob-name').value);
                    formData.append('bio', document.getElementById('ob-bio').value);
                    if (avatarFile) formData.append('avatar', avatarFile);

                    fetch('/onboarding', { method: 'POST', body: formData })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                btn.innerHTML = '<i class="bi bi-check2-circle"></i> Tersimpan!';
                                setTimeout(() => {
                                    bootstrap.Modal.getInstance(document.getElementById('onboardingModal')).hide();
                                    window.location.reload();
                                }, 800);
                            }
                        });
                }
            </script>
        @endif
    @endauth
@endsection
