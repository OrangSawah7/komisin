@extends('layouts.dashboard')

@section('title', 'Kelola User')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link">
        <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link">
        <i class="fas fa-paint-brush"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link">
        <i class="fas fa-box"></i> Kelola Order
    </a>
    <a href="/admin/users" class="nav-link active">
        <i class="fas fa-users"></i> Kelola User
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #CB2957; color: #fff;">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar User</h5>
    </div>

    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        @if($users->isEmpty())
            <p style="opacity:0.5;">Belum ada user terdaftar.</p>
        @else
            <table class="table table-borderless" style="color: #fff;">
                <thead>
                <tr style="border-bottom: 1px solid #333;">
                    <th style="opacity:0.5;">#</th>
                    <th style="opacity:0.5;">Nama</th>
                    <th style="opacity:0.5;">Email</th>
                    <th style="opacity:0.5;">Terdaftar</th>
                    <th style="opacity:0.5;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr style="border-bottom: 1px solid #222;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <form method="POST" action="/admin/users/{{ $user->id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm rounded-pill px-3 text-white"
                                        style="background-color: #CB2957;"
                                        onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
