@extends('layouts.dashboard')

@section('title', 'Kelola User')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link">
        <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link">
        <i class="bi bi-palette"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link">
        <i class="bi bi-box"></i> Kelola Order
    </a>
    <a href="/admin/users" class="nav-link active">
        <i class="bi bi-people"></i> Kelola User
    </a>
@endsection

@section('content')

    @if(session('success'))
        <div style="background:#D1FAE5; border:1px solid #6EE7B7; border-radius:12px; padding:12px 16px; margin-bottom:24px; font-size:0.875rem; color:#065F46; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="anim-fadeup delay-1" style="margin-bottom: 24px;">
        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Manajemen</div>
        <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0;">Kelola User</h5>
    </div>

    @if($users->isEmpty())
        <div class="anim-fadeup delay-2" style="background: white; border-radius: 20px; border: 1px solid var(--cream-dark); padding: 80px 40px; text-align: center;">
            <div style="width: 80px; height: 80px; background: var(--cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i class="bi bi-people" style="font-size: 2rem; color: var(--blue-light);"></i>
            </div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin-bottom: 8px;">Belum ada user</h5>
            <p style="color: var(--blue-light); font-size: 0.9rem; margin: 0;">Customer yang mendaftar akan muncul di sini.</p>
        </div>
    @else
        <div class="table-custom anim-fadeup delay-2">
            <table style="width:100%; border-collapse: collapse;">
                <thead>
                <tr style="border-bottom: 1px solid var(--cream-dark);">
                    <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">User</th>
                    <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Email</th>
                    <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Terdaftar</th>
                    <th style="padding: 14px 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr style="border-bottom: 1px solid var(--cream); transition: background-color 0.15s ease;"
                        onmouseover="this.style.backgroundColor='#c2c2d0'"
                        onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 14px 20px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--navy); color: var(--cream); display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 700; font-family: 'Playfair Display', serif; flex-shrink: 0;">
                                    @if($user->avatar)
                                        <img src="{{ Storage::url($user->avatar) }}" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <span style="font-weight: 500; color: var(--navy); font-size: 0.875rem;">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="padding: 14px 20px; font-size: 0.875rem; color: var(--blue-light);">{{ $user->email }}</td>
                        <td style="padding: 14px 20px; font-size: 0.875rem; color: var(--blue-light);">{{ $user->created_at->format('d M Y') }}</td>
                        <td style="padding: 14px 20px;">
                            <form method="POST" action="/admin/users/{{ $user->id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-custom" style="padding: 6px 14px; font-size: 0.8rem; border-radius: 10px;"
                                        onclick="return confirm('Yakin hapus user ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
