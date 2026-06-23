<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Komisiin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #111844;
            --blue: #4B5694;
            --blue-light: #7288AE;
            --cream: #EAE0CF;
            --cream-dark: #D9CCBA;
            --white: #FFFFFF;
            --text-dark: #111844;
            --text-mid: #4B5694;
            --text-light: #7288AE;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
        }

        /* Animasi */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(3deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .anim-fadeup { animation: fadeUp 0.8s ease forwards; opacity: 0; }
        .anim-fadein { animation: fadeIn 1s ease forwards; opacity: 0; }
        .anim-slideright { animation: slideRight 0.8s ease forwards; opacity: 0; }
        .anim-float { animation: float 6s ease-in-out infinite; }
        .anim-pulse { animation: pulse 3s ease-in-out infinite; }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Button */
        .btn { transition: all 0.25s ease !important; font-family: 'Inter', sans-serif; }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(17,24,68,0.15); }
        .btn-primary-custom {
            background-color: var(--navy);
            color: var(--cream);
            border: none;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 500;
        }
        .btn-outline-custom {
            background-color: transparent;
            color: var(--navy);
            border: 1.5px solid var(--navy);
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 500;
        }
        .btn-outline-custom:hover { background-color: var(--navy); color: var(--cream); }

        /* Card */
        .card-komisiin {
            background-color: var(--white);
            border-radius: 20px;
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .card-komisiin:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(17,24,68,0.12);
        }

        /* Navbar */
        .navbar-komisiin {
            background-color: var(--cream);
            border-bottom: 1px solid var(--cream-dark);
            padding: 16px 0;
        }
        .nav-link-custom {
            color: var(--text-light) !important;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .nav-link-custom:hover { color: var(--navy) !important; }

        /* Decorative shapes */
        .shape-circle {
            border-radius: 50%;
            position: absolute;
            pointer-events: none;
        }
        .shape-blob {
            border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%;
            position: absolute;
            pointer-events: none;
        }

        /* Badge */
        .badge-custom {
            background-color: var(--navy);
            color: var(--cream);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Section */
        .section-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--blue);
        }
    </style>
</head>
<body>
@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
