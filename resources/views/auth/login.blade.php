<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — Komisiin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #111844;
            --blue: #4B5694;
            --blue-light: #7288AE;
            --cream: #EAE0CF;
            --cream-dark: #D9CCBA;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: var(--cream); min-height: 100vh; display: flex; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .anim-fadeup { animation: fadeUp 0.7s ease forwards; opacity: 0; }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .anim-float { animation: float 6s ease-in-out infinite; }

        .left-panel {
            background-color: var(--navy);
            width: 45%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .right-panel {
            width: 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 80px;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .form-control-custom {
            background-color: transparent;
            border: 1.5px solid var(--cream-dark);
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 0.9rem;
            color: var(--navy);
            transition: all 0.2s ease;
            width: 100%;
        }
        .form-control-custom:focus {
            outline: none;
            border-color: var(--blue);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(75,86,148,0.1);
        }
        .form-control-custom::placeholder { color: var(--blue-light); }

        .btn-login {
            background-color: var(--navy);
            color: var(--cream);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 0.95rem;
            font-weight: 500;
            width: 100%;
            transition: all 0.25s ease;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: var(--blue);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(17,24,68,0.2);
        }

        .label-custom {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--blue);
            margin-bottom: 8px;
            display: block;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 40px 24px; }
        }
    </style>
</head>
<body>

{{-- LEFT PANEL --}}
<div class="left-panel">
    <div class="shape anim-float" style="width:300px; height:300px; background:var(--blue); opacity:0.15; top:-100px; right:-100px;"></div>
    <div class="shape anim-float" style="width:200px; height:200px; background:var(--blue-light); opacity:0.1; bottom:-50px; left:-50px; animation-delay:2s;"></div>

    <div style="position: relative; z-index: 1;">
        <a href="/" style="text-decoration: none;">
            <div style="font-family: 'Playfair Display', serif; font-size: 1.8rem; color: var(--cream); margin-bottom: 60px;">
                Komisiin
            </div>
        </a>
        <h2 style="font-family: 'Playfair Display', serif; color: var(--cream); font-size: 2.2rem; line-height: 1.3; margin-bottom: 20px;">
            Selamat datang <br>kembali
        </h2>
        <p style="color: var(--blue-light); font-size: 0.95rem; line-height: 1.8; max-width: 320px;">
            Masuk ke akunmu dan lanjutkan perjalanan kreatifmu bersama Komisiin.
        </p>

        <div style="margin-top: 60px; padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.08);">
            <div style="color: rgba(255,255,255,0.3); font-size: 0.8rem; margin-bottom: 16px; text-transform: uppercase; letter-spacing: 1px;">Belum punya akun?</div>
            <a href="/register" style="display: inline-flex; align-items: center; gap: 8px; color: var(--cream); text-decoration: none; font-size: 0.9rem; font-weight: 500;">
                Daftar sekarang <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- RIGHT PANEL --}}
<div class="right-panel">
    <div style="width: 100%; max-width: 400px;">
        <div class="anim-fadeup delay-1">
            <h3 style="font-family: 'Playfair Display', serif; color: var(--navy); font-size: 1.8rem; margin-bottom: 8px;">Masuk</h3>
            <p style="color: var(--blue-light); font-size: 0.9rem; margin-bottom: 40px;">Masukkan email dan password kamu</p>
        </div>

        @if ($errors->any())
            <div class="anim-fadeup delay-1" style="background-color: #fee2e2; border: 1px solid #fca5a5; border-radius: 12px; padding: 12px 16px; margin-bottom: 24px; font-size: 0.85rem; color: #dc2626;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="anim-fadeup delay-2" style="margin-bottom: 20px;">
                <label class="label-custom">Email</label>
                <input type="email" name="email" class="form-control-custom"
                       placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="anim-fadeup delay-3" style="margin-bottom: 32px;">
                <label class="label-custom">Password</label>
                <input type="password" name="password" class="form-control-custom"
                       placeholder="••••••••" required>
            </div>

            <div class="anim-fadeup delay-4">
                <button type="submit" class="btn-login">
                    Masuk <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </div>
        </form>

        <div class="anim-fadeup delay-4 text-center" style="margin-top: 24px;">
            <span style="color: var(--blue-light); font-size: 0.85rem;">Belum punya akun? </span>
            <a href="/register" style="color: var(--navy); font-size: 0.85rem; font-weight: 600; text-decoration: none;">Daftar</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
