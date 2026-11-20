@extends('layouts.app')

@section('content')

<div class="container-fluid px-0">

    <div class="mb-4">
        <h3 class="font-weight-bold text-gray-800">
            <i class="fas fa-box-open text-primary mr-2"></i>
            Tambah Produk
        </h3>

        <p class="text-muted mb-0">
            Dashboard / Produk / Tambah Produk
        </p>
    </div>

    <form method="POST"
          action="{{ route('products.store') }}"
          enctype="multipart/form-data">

        @csrf

        @include('products._form')

        <div class="mb-4">
            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                <i class="fas fa-save mr-2"></i>
                Simpan Produk
            </button>

            <a href="{{ route('products.index') }}"
               class="btn btn-light border px-4 ml-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Batal
            </a>
        </div>

    </form>

</div>

@endsection
