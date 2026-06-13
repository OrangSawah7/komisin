@extends('layouts.dashboard')

@section('title', 'Kelola Komisi')

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
    @if(session('success'))
        <div class="alert rounded-4 mb-4" style="background-color: #1a1a1a; border: 1px solid #CB2957; color: #fff;">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Komisi</h5>
        <a href="/admin/commissions/create" class="btn rounded-pill px-4 text-white fw-bold" style="background-color: #CB2957;">
            <i class="fas fa-plus me-1"></i> Tambah Komisi
        </a>
    </div>

    <div class="p-4 rounded-4" style="background-color: #1a1a1a; border: 1px solid #333;">
        @if($commissions->isEmpty())
            <p style="opacity:0.5;">Belum ada komisi.</p>
        @else
            <table class="table table-borderless" style="color: #fff;">
                <thead>
                <tr style="border-bottom: 1px solid #333;">
                    <th style="opacity:0.5;">#</th>
                    <th style="opacity:0.5;">Judul</th>
                    <th style="opacity:0.5;">Kategori</th>
                    <th style="opacity:0.5;">Harga</th>
                    <th style="opacity:0.5;">Status</th>
                    <th style="opacity:0.5;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commissions as $commission)
                    <tr style="border-bottom: 1px solid #222;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $commission->title }}</td>
                        <td>{{ $commission->category }}</td>
                        <td>Rp {{ number_format($commission->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge rounded-pill" style="background-color: #CB2957;">
                                {{ $commission->status }}
                            </span>
                        </td>
                        <td>
                            <a href="/admin/commissions/{{ $commission->id }}/edit" class="btn btn-sm btn-outline-dark rounded-pill px-3 me-1">Edit</a>
                            <form method="POST" action="/admin/commissions/{{ $commission->id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm rounded-pill px-3 text-white" style="background-color: #CB2957;"
                                        onclick="return confirm('Yakin hapus komisi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
