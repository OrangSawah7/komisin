<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Komisiin — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #111111; color: #fff; }

        /* SIDEBAR */
        .sidebar { width: 260px; min-height: 100vh; background-color: #000000; position: fixed; top: 0; left: 0; border-right: 1px solid #CB2957; display: flex; flex-direction: column; }
        .sidebar .brand { padding: 25px 25px 20px; font-size: 1.3rem; font-weight: 700; border-bottom: 1px solid rgba(203,41,87,0.3); margin-bottom: 10px; }
        .sidebar .nav-section { padding: 8px 15px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.3); margin-top: 10px; }
        .sidebar .nav-link { color: rgba(255,255,255,0.6); padding: 12px 25px; margin: 2px 10px; border-radius: 10px; transition: all .2s; display: flex; align-items: center; gap: 12px; font-size: 0.9rem; }
        .sidebar .nav-link:hover { color: #fff; background-color: rgba(203,41,87,0.2); }
        .sidebar .nav-link.active { color: #fff; background-color: #CB2957; }
        .sidebar .nav-link i { width: 18px; text-align: center; font-size: 0.95rem; }

        /* TOPBAR */
        .topbar { background-color: #000000; border-bottom: 1px solid rgba(203,41,87,0.4); padding: 15px 30px; margin-left: 260px; position: sticky; top: 0; z-index: 100; display: flex; justify-content: space-between; align-items: center; }

        /* MAIN */
        .main-content { margin-left: 260px; padding: 30px; min-height: 100vh; }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="brand">
        🎨 <span style="color: #CB2957;">Komis</span>iin
    </div>
    <nav class="nav flex-column">
        @yield('sidebar-menu')
    </nav>
</div>

{{-- TOPBAR --}}
<div class="topbar">
    <div style="font-size: 1rem; font-weight: 600;">@yield('title')</div>
    <div class="user-info d-flex align-items-center gap-3">
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">Logout</button>
        </form>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
