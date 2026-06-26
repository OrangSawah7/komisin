@extends('layouts.dashboard')

@section('title', 'Buat Order')

@section('sidebar-menu')
    <a href="/customer/profile" class="nav-link">
        <i class="bi bi-person"></i> Profil Saya
    </a>
    <a href="/" class="nav-link">
        <i class="bi bi-grid-3x3-gap"></i> Browse Komisi
    </a>
    <a href="/customer/orders" class="nav-link active">
        <i class="bi bi-box"></i> Order Saya
    </a>
@endsection

@section('content')

    <div class="anim-fadeup delay-1" style="display: flex; align-items: center; gap: 14px; margin-bottom: 28px;">
        <a href="/" style="width: 36px; height: 36px; border-radius: 50%; background: white; border: 1px solid var(--cream-dark); display: flex; align-items: center; justify-content: center; color: var(--navy); text-decoration: none; transition: all 0.2s ease;"
           onmouseover="this.style.background='var(--navy)'; this.style.color='var(--cream)'"
           onmouseout="this.style.background='white'; this.style.color='var(--navy)'">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 2px;">Order Baru</div>
            <h5 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0; font-size: 1.4rem;">Buat Order</h5>
        </div>
    </div>

    <div class="row g-4">
        {{-- Kolom kiri: form --}}
        <div class="col-lg-8">
            <form method="POST" action="/customer/orders/{{ $commission->id }}" enctype="multipart/form-data">
                @csrf

                <div class="form-card anim-fadeup delay-2" style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--cream-dark);">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-chat-text" style="color: var(--navy); font-size: 0.9rem;"></i>
                        </div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Catatan untuk Admin</div>
                    </div>

                    <label class="form-label-custom">Brief / Catatan <span style="text-transform: none; font-weight: 400; color: var(--blue-light);">(opsional)</span></label>
                    <textarea name="note" class="form-input-custom" rows="5"
                              placeholder="Ceritakan detail yang kamu inginkan untuk komisi ini...">{{ old('note') }}</textarea>
                    @error('note')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                </div>

                <div class="form-card anim-fadeup delay-3" style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--cream-dark);">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-image" style="color: var(--navy); font-size: 0.9rem;"></i>
                        </div>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Foto Referensi</div>
                    </div>

                    <label for="reference-input" id="upload-area" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; height: 160px; border: 1.5px dashed var(--cream-dark); border-radius: 14px; background: var(--cream); cursor: pointer; transition: all 0.2s ease; overflow: hidden; position: relative;"
                           onmouseover="this.style.borderColor='var(--blue)'"
                           onmouseout="this.style.borderColor='var(--cream-dark)'">
                        <img id="preview-img" src="" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                        <div id="upload-placeholder" style="display:flex; flex-direction:column; align-items:center; gap:8px;">
                            <i class="bi bi-cloud-arrow-up" style="font-size: 1.8rem; color: var(--blue-light);"></i>
                            <span style="font-size: 0.8rem; color: var(--blue-light); text-align: center;">Klik untuk upload foto referensi</span>
                        </div>
                    </label>
                    <input type="file" id="reference-input" name="reference_image" accept="image/jpg,image/jpeg,image/png" style="display:none;" onchange="previewReference(this)">

                    <div style="font-size: 0.75rem; color: var(--blue-light); margin-top: 10px; text-align: center;">JPG atau PNG, maksimal 2MB</div>
                    @error('reference_image')<div style="font-size:0.8rem; color:#dc2626; margin-top:6px;">{{ $message }}</div>@enderror
                </div>

                <div class="anim-fadeup delay-4" style="display: flex; gap: 12px;">
                    <button type="submit" class="btn-navy">
                        <i class="bi bi-send-check"></i> Order Sekarang
                    </button>
                    <a href="/" class="btn-outline-navy">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        {{-- Kolom kanan: ringkasan komisi --}}
        <div class="col-lg-4">
            <div class="form-card anim-fadeup delay-2" style="position: sticky; top: 90px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--cream-dark);">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--cream); display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-receipt" style="color: var(--navy); font-size: 0.9rem;"></i>
                    </div>
                    <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">Ringkasan Komisi</div>
                </div>

                @if($commission->thumbnail)
                    <img src="{{ Storage::url($commission->thumbnail) }}"
                         style="width:100%; height:160px; object-fit:cover; border-radius: 12px; margin-bottom: 16px;">
                @else
                    <div style="height:160px; background: linear-gradient(135deg, var(--navy), var(--blue)); border-radius: 12px; margin-bottom: 16px; display:flex; align-items:center; justify-content:center;">
                        <i class="bi bi-palette" style="font-size: 2rem; color: var(--cream); opacity:0.5;"></i>
                    </div>
                @endif

                <span style="background: var(--cream); color: var(--blue); font-size: 0.7rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; letter-spacing: 0.5px;">
                    {{ $commission->category }}
                </span>
                <h6 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 10px 0 8px; font-size: 1.05rem;">{{ $commission->title }}</h6>
                <p style="color: var(--blue-light); font-size: 0.85rem; line-height: 1.6; margin-bottom: 16px;">
                    {{ $commission->description }}
                </p>

                <div style="border-top: 1px solid var(--cream-dark); padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: var(--blue-light);">Total Harga</span>
                    <span style="font-weight: 700; color: var(--navy); font-size: 1.2rem;">
                        Rp {{ number_format($commission->price, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewReference(input) {
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
