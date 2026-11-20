@php
    $existingImage = $product->image ?? null;
@endphp

@push('styles')
<style>
    .product-form-card {
        border: 1px solid #e8edf5;
        border-radius: 12px;
        overflow: hidden;
    }

    .product-section-title {
        color: #2455a6;
        font-weight: 700;
        font-size: 17px;
    }

    .product-label {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 8px;
    }

    .product-input {
        border-radius: 8px;
        min-height: 43px;
        border: 1px solid #dce2ec;
    }

    .product-input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 3px rgba(78,115,223,.12);
    }

    .product-preview {
        width: 100%;
        height: 220px;
        object-fit: contain;
        border: 2px dashed #dce3ef;
        border-radius: 10px;
        padding: 10px;
        background: #f8faff;
    }

    .upload-area {
        background: #f5f8ff;
        border: 1px dashed #9bb5ec;
        border-radius: 10px;
        padding: 15px;
    }

    .stock-status {
        display: inline-block;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        margin-top: 8px;
    }

    .stock-available {
        background: #d1f7df;
        color: #168343;
    }

    .stock-low {
        background: #fff0c2;
        color: #a66a00;
    }

    .stock-empty {
        background: #ffe0e0;
        color: #c62828;
    }

    .product-help {
        font-size: 12px;
        color: #858d9b;
    }
</style>
@endpush

<div class="row">

    {{-- BAGIAN FORM PRODUK --}}
    <div class="col-lg-8 mb-4">
        <div class="card product-form-card shadow-sm h-100">

            <div class="card-header bg-white py-3">
                <h6 class="product-section-title mb-0">
                    <i class="fas fa-edit mr-2"></i>
                    Informasi Produk
                </h6>
            </div>

            <div class="card-body p-4">

                <div class="form-row">

                    {{-- KODE PRODUK --}}
                    <div class="form-group col-md-6">
                        <label class="product-label">Kode Produk</label>

                        <input type="text"
                               name="product_code"
                               class="form-control product-input @error('product_code') is-invalid @enderror"
                               value="{{ old('product_code', $product->product_code ?? '') }}"
                               placeholder="Contoh: PRD001">

                        @error('product_code')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA PRODUK --}}
                    <div class="form-group col-md-6">
                        <label class="product-label">Nama Produk *</label>

                        <input type="text"
                               name="name"
                               class="form-control product-input @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name ?? '') }}"
                               placeholder="Masukkan nama produk">

                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="form-group col-md-6">
                        <label class="product-label">Kategori *</label>

                        <select name="category_id"
                                class="custom-select product-input @error('category_id') is-invalid @enderror">

                            <option value="">Pilih kategori</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- MEREK --}}
                    <div class="form-group col-md-6">
                        <label class="product-label">Merek</label>

                        <input type="text"
                               name="brand"
                               class="form-control product-input @error('brand') is-invalid @enderror"
                               value="{{ old('brand', $product->brand ?? '') }}"
                               placeholder="Contoh: Samsung, Apple">

                        @error('brand')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- HARGA --}}
                    <div class="form-group col-md-6">
                        <label class="product-label">Harga *</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold">Rp</span>
                            </div>

                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   name="price"
                                   class="form-control product-input @error('price') is-invalid @enderror"
                                   value="{{ old('price', $product->price ?? '') }}"
                                   placeholder="Masukkan harga">
                        </div>

                        @error('price')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- STOK --}}
                    <div class="form-group col-md-6">
                        <label class="product-label">Stok Produk *</label>

                        <input type="number"
                               min="0"
                               name="stock"
                               id="productStock"
                               class="form-control product-input @error('stock') is-invalid @enderror"
                               value="{{ old('stock', $product->stock ?? 0) }}"
                               placeholder="Jumlah stok">

                        <div id="stockStatus" class="stock-status"></div>

                        @error('stock')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="form-group col-12">
                        <label class="product-label">Deskripsi Produk</label>

                        <textarea name="description"
                                  rows="4"
                                  class="form-control product-input @error('description') is-invalid @enderror"
                                  placeholder="Tuliskan informasi dan spesifikasi produk...">{{ old('description', $product->description ?? '') }}</textarea>

                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- BAGIAN GAMBAR PRODUK --}}
    <div class="col-lg-4 mb-4">
        <div class="card product-form-card shadow-sm h-100">

            <div class="card-header bg-white py-3">
                <h6 class="product-section-title mb-0">
                    <i class="fas fa-image mr-2"></i>
                    Gambar Produk
                </h6>
            </div>

            <div class="card-body p-4">

                <img id="imagePreview"
                     src="{{ $existingImage ? asset('storage/' . $existingImage) : '' }}"
                     class="product-preview mb-3"
                     alt="Preview Produk"
                     style="{{ $existingImage ? '' : 'display:none;' }}">

                <div id="imagePlaceholder"
                     class="upload-area text-center mb-3"
                     style="{{ $existingImage ? 'display:none;' : '' }}">

                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>

                    <p class="font-weight-bold mb-1">
                        Pilih gambar produk
                    </p>

                    <small class="text-muted">
                        JPG, JPEG, PNG atau WEBP
                    </small>

                </div>

                <input type="file"
                       name="image"
                       id="productImage"
                       accept=".jpg,.jpeg,.png,.webp"
                       class="form-control-file w-100">

                <small class="product-help d-block mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Ukuran maksimal gambar 5 MB.
                </small>

                @error('image')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror

                <hr>

                <div class="p-3 rounded" style="background:#f5f8ff;">

                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-box mr-2"></i>
                        Informasi Stok
                    </h6>

                    <div class="mb-2">
                        <span class="text-success mr-2">●</span>
                        Tersedia: Stok di atas 5
                    </div>

                    <div class="mb-2">
                        <span class="text-warning mr-2">●</span>
                        Stok Menipis: 1–5
                    </div>

                    <div>
                        <span class="text-danger mr-2">●</span>
                        Habis: Stok 0
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    // PREVIEW GAMBAR
    document.getElementById('productImage').addEventListener('change', function(event) {

        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('imagePlaceholder');

        if (!file) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Format gambar harus JPG, JPEG, PNG, atau WEBP.');
            event.target.value = '';
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 5 MB.');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };

        reader.readAsDataURL(file);
    });

    // INDIKATOR STOK OTOMATIS
    const stockInput = document.getElementById('productStock');
    const stockStatus = document.getElementById('stockStatus');

    function updateStockStatus() {

        const stock = Number(stockInput.value);

        if (stock <= 0 || stockInput.value === '') {

            stockStatus.textContent = '● Stok Habis';
            stockStatus.className = 'stock-status stock-empty';

        } else if (stock <= 5) {

            stockStatus.textContent = '● Stok Menipis';
            stockStatus.className = 'stock-status stock-low';

        } else {

            stockStatus.textContent = '● Stok Tersedia';
            stockStatus.className = 'stock-status stock-available';

        }
    }

    stockInput.addEventListener('input', updateStockStatus);

    updateStockStatus();
</script>
@endpush
