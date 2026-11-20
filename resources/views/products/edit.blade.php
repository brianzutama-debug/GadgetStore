@extends('layouts.app')

@section('content')

<div class="container-fluid px-0">

    <div class="mb-4">
        <h3 class="font-weight-bold text-gray-800">
            <i class="fas fa-edit text-primary mr-2"></i>
            Edit Produk
        </h3>

        <p class="text-muted mb-0">
            Dashboard / Produk / Edit Produk
        </p>
    </div>

    <form method="POST"
          action="{{ route('products.update', $product) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('products._form')

        <div class="mb-4">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-2"></i>
                Simpan Perubahan
            </button>

            <a href="{{ route('products.index') }}"
               class="btn btn-light border ml-2 px-4">
                <i class="fas fa-arrow-left mr-2"></i>
                Batal
            </a>
        </div>

    </form>

</div>

@endsection
