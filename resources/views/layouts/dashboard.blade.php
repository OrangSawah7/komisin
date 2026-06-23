<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Komisiin — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #111844;
            --blue: #4B5694;
            --blue-light: #7288AE;
            --cream: #EAE0CF;
            --cream-dark: #D9CCBA;
            --white: #FFFFFF;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--cream);
            color: var(--navy);
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--navy);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-brand a {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--cream);
            text-decoration: none;
        }

        .sidebar-section {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 20px 24px 8px;
        }

        .sidebar-nav { padding: 8px 12px; flex-grow: 1; }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.5);
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 2px;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .sidebar .nav-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            color: var(--cream);
            background-color: rgba(255,255,255,0.06);
        }

        .sidebar .nav-link.active {
            color: var(--cream);
            background-color: rgba(255,255,255,0.1);
            border-left: 3px solid var(--cream);
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        /* TOPBAR */
        .topbar {
            margin-left: 260px;
            background-color: var(--cream);
            border-bottom: 1px solid var(--cream-dark);
            padding: 16px 32px;
            position: sticky;
            top: 0;
            z-index: 99;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--navy);
            font-weight: 700;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--navy);
            color: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 32px;
            min-height: 100vh;
        }

        /* CARDS */
        .stat-card {
            background-color: var(--white);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--cream-dark);
            transition: all 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(17,24,68,0.08);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background-color: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--navy);
            margin-bottom: 16px;
        }

        /* TABLE */
        .table-custom {
            background-color: var(--white);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--cream-dark);
        }

        .table-custom table {
            width: 100%;
            border-collapse: collapse;
            color: var(--navy);
        }

        .table-custom thead tr {
            border-bottom: 1px solid var(--cream-dark);
        }

        .table-custom thead th {
            padding: 14px 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--blue-light);
        }

        .table-custom tbody td {
            padding: 14px 20px;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--cream);
        }

        .table-custom tbody tr:last-child td { border-bottom: none; }
        .table-custom tbody tr:hover { background-color: var(--cream); }

        /* BADGE STATUS */
        .status-badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .status-waiting { background-color: #DBEAFE; color: #1E40AF; }
        .status-progress { background-color: #D1FAE5; color: #065F46; }
        .status-completed { background-color: #D1FAE5; color: #065F46; }
        .status-rejected { background-color: #FEE2E2; color: #991B1B; }
        .status-cancelled { background-color: #F3F4F6; color: #374151; }
        .status-approved { background-color: #D1FAE5; color: #065F46; }

        /* FORM */
        .form-card {
            background-color: var(--white);
            border-radius: 16px;
            padding: 32px;
            border: 1px solid var(--cream-dark);
        }

        .form-label-custom {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--blue);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
        }

        .form-input-custom {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--cream-dark);
            border-radius: 10px;
            font-size: 0.9rem;
            color: var(--navy);
            background-color: var(--cream);
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-input-custom:focus {
            outline: none;
            border-color: var(--blue);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(75,86,148,0.1);
        }

        /* BTN */
        .btn-navy {
            background-color: var(--navy);
            color: var(--cream);
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-navy:hover {
            background-color: var(--blue);
            color: var(--cream);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(17,24,68,0.15);
        }

        .btn-outline-navy {
            background-color: transparent;
            color: var(--navy);
            border: 1.5px solid var(--cream-dark);
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-outline-navy:hover {
            border-color: var(--navy);
            color: var(--navy);
        }

        .btn-danger-custom {
            background-color: #FEE2E2;
            color: #991B1B;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-danger-custom:hover { background-color: #FECACA; }

        /* ANIMASI */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .anim-fadeup { animation: fadeUp 0.5s ease forwards; opacity: 0; }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .topbar { margin-left: 0; padding: 14px 20px; }
            .main-content { margin-left: 0; padding: 20px; }
        }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="/">Komisiin</a>
    </div>
    <div class="sidebar-nav">
        <div class="sidebar-section">Menu</div>
        @yield('sidebar-menu')
    </div>
    <div class="sidebar-footer">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="sidebar-nav" style="background:none; border:none; width:100%; text-align:left;">
                <span class="nav-link" style="color: rgba(255,255,255,0.4);">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </span>
            </button>
        </form>
    </div>
</div>

{{-- TOPBAR --}}
<div class="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="d-md-none btn border-0 p-0" onclick="toggleSidebar()">
            <i class="bi bi-list" style="font-size: 1.5rem; color: var(--navy);"></i>
        </button>
        <div class="topbar-title">@yield('title')</div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div style="text-align: right; display: none;" class="d-none d-md-block">
            <div style="font-size: 0.875rem; font-weight: 600; color: var(--navy);">{{ auth()->user()->name }}</div>
            <div style="font-size: 0.75rem; color: var(--blue-light);">{{ ucfirst(auth()->user()->role) }}</div>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>
</body>
</html>
