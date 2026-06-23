@extends('layouts.dashboard')

@section('title', 'Edit Komisi')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link">
        <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link active">
        <i class="bi bi-palette"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link">
        <i class="bi bi-box"></i> Kelola Order
    </a>
    <a href="/admin/users" class="nav-link">
        <i class="bi bi-people"></i> Kelola User
    </a>
@endsection

@section('content')

    <div class="anim-fadeup delay-1" style="display: flex; align-items: center; gap: 14px; margin-bottom: 28px;">
        <a href="/admin/commissions" style="width: 36px; height: 36px; border-radius: 50%; background: white; border: 1px solid var(--cream-dark); display: flex; align-items: center; justify-content: center; color: var(--navy); text-decoration: none; transition: all 0.2s ease;"
           onmouseover="this.style.background='var(--navy)'; this.style.color='var(--cream)'"
           onmouseout="this.style.background='white'; this.style.color='var(--navy)'">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 2px;">Edit</div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0; font-size: 1.4rem;">{{ $commission->title }}</h5>
        </div>
    </div>

    <form method="POST" action="/admin/commissions/{{ $commission->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            {{-- Kolom kiri: form utama --}}
            <div class="col-lg-8">
                <div class="form-card anim-fadeup delay-2">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--cream-dark);">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-card-text" style="color: var(--navy); font-size: 0.9rem;"></i>
                        </div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Informasi Komisi</div>
                    </div>

                    <div style="margin-bottom: 22px;">
                        <label class="form-label-custom">Judul Komisi</label>
                        <input type="text" name="title" class="form-input-custom"
                               value="{{ old('title', $commission->title) }}" required>
                        @error('title')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3" style="margin-bottom: 22px;">
                        <div class="col-md-6">
                            <label class="form-label-custom">Kategori</label>
                            <input type="text" name="category" class="form-input-custom"
                                   value="{{ old('category', $commission->category) }}" required>
                            @error('category')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Harga</label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--blue-light); font-size: 0.9rem; font-weight: 500;">Rp</span>
                                <input type="number" name="price" class="form-input-custom"
                                       style="padding-left: 42px;"
                                       value="{{ old('price', $commission->price) }}" required>
                            </div>
                            @error('price')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="form-label-custom">Deskripsi</label>
                        <textarea name="description" class="form-input-custom" rows="6">{{ old('description', $commission->description) }}</textarea>
                        @error('description')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Kolom kanan: foto + aksi --}}
            <div class="col-lg-4">
                <div class="form-card anim-fadeup delay-3" style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--cream-dark);">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-image" style="color: var(--navy); font-size: 0.9rem;"></i>
                        </div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Foto Komisi</div>
                    </div>

                    <label for="thumbnail-input" id="upload-area" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; height: 160px; border: 1.5px dashed var(--cream-dark); border-radius: 14px; background: var(--cream); cursor: pointer; transition: all 0.2s ease; overflow: hidden; position: relative;"
                           onmouseover="this.style.borderColor='var(--blue)'"
                           onmouseout="this.style.borderColor='var(--cream-dark)'">
                        @if($commission->thumbnail)
                            <img id="preview-img" src="{{ Storage::url($commission->thumbnail) }}" style="display:block; position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                            <div id="upload-placeholder" style="display:none; flex-direction:column; align-items:center; gap:8px;">
                                <i class="bi bi-cloud-arrow-up" style="font-size: 1.8rem; color: var(--blue-light);"></i>
                                <span style="font-size: 0.8rem; color: var(--blue-light); text-align: center;">Klik untuk ganti foto</span>
                            </div>
                        @else
                            <img id="preview-img" src="" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                            <div id="upload-placeholder" style="display:flex; flex-direction:column; align-items:center; gap:8px;">
                                <i class="bi bi-cloud-arrow-up" style="font-size: 1.8rem; color: var(--blue-light);"></i>
                                <span style="font-size: 0.8rem; color: var(--blue-light); text-align: center;">Klik untuk upload foto</span>
                            </div>
                        @endif
                    </label>
                    <input type="file" id="thumbnail-input" name="thumbnail" accept="image/jpg,image/jpeg,image/png" style="display:none;" onchange="previewThumbnail(this)">

                    <div style="font-size: 0.75rem; color: var(--blue-light); margin-top: 10px; text-align: center;">JPG atau PNG, maksimal 2MB</div>
                    @error('thumbnail')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                </div>

                <div class="anim-fadeup delay-4" style="display: flex; flex-direction: column; gap: 10px;">
                    <button type="submit" class="btn-navy" style="justify-content: center; padding: 13px;">
                        <i class="bi bi-check2"></i> Simpan Perubahan
                    </button>
                    <a href="/admin/commissions" class="btn-outline-navy" style="justify-content: center; padding: 12px;">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewThumbnail(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('preview-img').style.display = 'block';
                    document.getElementById('upload-placeholder').style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
