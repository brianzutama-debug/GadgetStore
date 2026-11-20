
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_heading', 'Dashboard Gadget Store')

@push('styles')
<style>
    /* BANNER DASHBOARD */
    .dashboard-welcome {
        background: linear-gradient(120deg, #e8f0ff, #f3efff);
        border-radius: 18px;
        padding: 25px 30px;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .dashboard-welcome h3 {
        color: #263f75;
        font-weight: 800;
    }

    .dashboard-welcome p {
        color: #7182a5;
    }

    .gadget-banner {
        width: 100%;
        max-width: 390px;
        height: 145px;
        object-fit: contain;
    }

    /* KARTU STATISTIK */
    .stat-card {
        border: none;
        border-radius: 16px;
        transition: .2s;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-card .card-body {
        padding: 22px;
    }

    .stat-number {
        font-size: 30px;
        font-weight: 800;
        color: #263b68;
    }

    .stat-label {
        color: #71809c;
        font-size: 14px;
        font-weight: 600;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .stat-blue { background: #e8f1ff; }
    .stat-purple { background: #f0eaff; }
    .stat-orange { background: #fff1df; }
    .stat-red { background: #ffe9eb; }

    .icon-blue { color: #4385e8; }
    .icon-purple { color: #9270dc; }
    .icon-orange { color: #e9a044; }
    .icon-red { color: #e36c79; }

    /* KARTU KONTEN */
    .dashboard-card {
        border: none;
        border-radius: 17px;
        box-shadow: 0 4px 18px rgba(50, 80, 130, .07);
        height: 100%;
    }

    .dashboard-card .card-body {
        padding: 22px;
    }

    .dashboard-title {
        color: #344b78;
        font-weight: 750;
        font-size: 17px;
        margin-bottom: 20px;
    }

    .chart-area {
        height: 270px;
        position: relative;
    }

    /* TOMBOL AKSES CEPAT */
    .quick-btn {
        display: block;
        width: 100%;
        padding: 13px;
        border-radius: 10px;
        font-weight: 600;
        margin-bottom: 12px;
        text-align: center;
        text-decoration: none !important;
        transition: .2s;
    }

    .quick-primary {
        background: #477fe0;
        color: white !important;
    }

    .quick-secondary {
        background: #edf3ff;
        color: #416db9 !important;
    }

    .quick-btn:hover {
        opacity: .85;
        transform: translateY(-2px);
    }

    /* NILAI PERSEDIAAN */
    .inventory-box {
        background: linear-gradient(135deg, #edf3ff, #f2edff);
        border-radius: 13px;
        padding: 20px;
    }

    .inventory-value {
        font-size: 23px;
        font-weight: 800;
        color: #416fc1;
    }

    /* TABEL PRODUK */
    .dashboard-table th {
        color: #7a88a2;
        font-size: 12px;
        text-transform: uppercase;
        border-top: none;
    }

    .dashboard-table td {
        color: #53627e;
        vertical-align: middle;
        font-size: 13px;
    }

    .table-product {
        font-weight: 700;
        color: #344b78;
    }

    .stock-badge {
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .stock-good {
        background: #e2f7eb;
        color: #27965b;
    }

    .stock-low {
        background: #fff1d9;
        color: #ce8a22;
    }

    .stock-empty {
        background: #ffe6e8;
        color: #d94f5c;
    }

    @media(max-width: 768px) {
        .dashboard-welcome {
            padding: 20px;
        }

        .gadget-banner {
            max-width: 230px;
            height: 110px;
            margin-top: 15px;
        }
    }
</style>
@endpush


@section('content')

{{-- BANNER SAMBUTAN --}}
<div class="dashboard-welcome">
    <div class="row align-items-center">

        <div class="col-md-7">
            <h3>Halo, Admin! 👋</h3>

            <p class="mb-2">
                Selamat datang kembali di Dashboard Gadget Store.
            </p>

            <p class="small mb-0">
                Kelola produk dan pantau kondisi inventaris toko dengan mudah.
            </p>
        </div>

        <div class="col-md-5 text-center">
            <img
                src="{{ asset('images/gadget-banner.png') }}"
                alt="Ilustrasi Gadget Store"
                class="img-fluid gadget-banner">
        </div>

    </div>
</div>


{{-- STATISTIK PRODUK --}}
<div class="row mb-4">

    {{-- TOTAL PRODUK --}}
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card stat-card shadow-sm stat-blue">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-number">
                            {{ number_format($totalProducts) }}
                        </div>
                    </div>

                    <div class="stat-icon icon-blue">
                        <i class="fas fa-box"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- KATEGORI --}}
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card stat-card shadow-sm stat-purple">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-label">Kategori</div>
                        <div class="stat-number">
                            {{ number_format($totalCategories) }}
                        </div>
                    </div>

                    <div class="stat-icon icon-purple">
                        <i class="fas fa-tags"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL STOK --}}
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card stat-card shadow-sm stat-orange">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-label">Total Unit Stok</div>
                        <div class="stat-number">
                            {{ number_format($totalStock) }}
                        </div>
                    </div>

                    <div class="stat-icon icon-orange">
                        <i class="fas fa-boxes"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- STOK MENIPIS --}}
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card stat-card shadow-sm stat-red">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-label">Stok Menipis (≤ 5)</div>
                        <div class="stat-number">
                            {{ number_format($lowStockProducts) }}
                        </div>
                    </div>

                    <div class="stat-icon icon-red">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


{{-- GRAFIK DAN AKSES CEPAT --}}
<div class="row mb-4">

    {{-- GRAFIK KATEGORI --}}
    <div class="col-lg-5 mb-3">
        <div class="card dashboard-card">
            <div class="card-body">

                <h5 class="dashboard-title">
                    <i class="fas fa-chart-bar text-primary mr-2"></i>
                    Produk per Kategori
                </h5>

                <div class="chart-area">
                    <canvas id="categoryChart"></canvas>
                </div>

            </div>
        </div>
    </div>

    {{-- GRAFIK KONDISI STOK --}}
    <div class="col-lg-4 mb-3">
        <div class="card dashboard-card">
            <div class="card-body">

                <h5 class="dashboard-title">
                    <i class="fas fa-chart-pie text-primary mr-2"></i>
                    Kondisi Stok
                </h5>

                <div class="chart-area">
                    <canvas id="stockChart"></canvas>
                </div>

                <div class="small text-muted text-center mt-2">
                    Menipis: 0–5 | Cukup: 6–20 | Banyak: >20
                </div>

            </div>
        </div>
    </div>

    {{-- AKSES CEPAT --}}
    <div class="col-lg-3 mb-3">
        <div class="card dashboard-card">
            <div class="card-body">

                <h5 class="dashboard-title">
                    <i class="fas fa-bolt text-warning mr-2"></i>
                    Akses Cepat
                </h5>

                <a href="{{ route('products.create') }}"
                   class="quick-btn quick-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Produk
                </a>

                <a href="{{ route('products.index') }}"
                   class="quick-btn quick-secondary">
                    <i class="fas fa-list mr-2"></i>
                    Data Produk
                </a>

                <div class="inventory-box mt-3">

                    <div class="small text-muted mb-2">
                        Estimasi Nilai Persediaan
                    </div>

                    <div class="inventory-value">
                        Rp {{ number_format($inventoryValue, 0, ',', '.') }}
                    </div>

                    <div class="small text-muted mt-2">
                        Harga produk × jumlah stok.
                        Bukan omzet atau laba.
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>


{{-- GRAFIK STOK PER KATEGORI --}}
<div class="row mb-4">
    <div class="col-12">

        <div class="card dashboard-card">
            <div class="card-body">

                <h5 class="dashboard-title">
                    <i class="fas fa-chart-column text-primary mr-2"></i>
                    Total Unit Stok per Kategori
                </h5>

                <div class="chart-area">
                    <canvas id="stockByCategoryChart"></canvas>
                </div>

            </div>
        </div>

    </div>
</div>


{{-- TABEL PRODUK TERBARU --}}
<div class="card dashboard-card mb-4">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="dashboard-title mb-0">
                <i class="fas fa-clock text-primary mr-2"></i>
                Produk Terbaru
            </h5>

            <a href="{{ route('products.index') }}"
               class="btn btn-sm btn-outline-primary">
                Lihat Semua
                <i class="fas fa-arrow-right ml-1"></i>
            </a>

        </div>

        <div class="table-responsive">

            <table class="table dashboard-table table-hover">

                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($latestProducts as $product)

                        <tr>

                            <td>
                                {{ $product->product_code }}
                            </td>

                            <td class="table-product">
                                {{ $product->name }}
                            </td>

                            <td>
                                {{ optional($product->category)->name ?? '-' }}
                            </td>

                            <td>
                                Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                            </td>

                            <td>

                                @if($product->stock == 0)

                                    <span class="stock-badge stock-empty">
                                        Habis
                                    </span>

                                @elseif($product->stock <= 5)

                                    <span class="stock-badge stock-low">
                                        {{ $product->stock }} Unit
                                    </span>

                                @else

                                    <span class="stock-badge stock-good">
                                        {{ $product->stock }} Unit
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-box-open fa-2x mb-2"></i>
                                <br>
                                Belum ada produk. Silakan tambahkan produk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection


{{-- JAVASCRIPT GRAFIK --}}
@push('scripts')
<script>

    // DATA DARI DATABASE
    const categoryLabels = @json($categoryStats->pluck('name')->values());

    const productCounts = @json(
        $categoryStats->pluck('product_count')->map(fn($v) => (int) $v)->values()
    );

    const stockTotals = @json(
        $categoryStats->pluck('stock_total')->map(fn($v) => (int) $v)->values()
    );

    const stockStatus = @json($stockStatus);


    // GRAFIK PRODUK PER KATEGORI
    new Chart(document.getElementById('categoryChart'), {

        type: 'bar',

        data: {
            labels: categoryLabels,

            datasets: [{
                label: 'Jumlah Produk',
                data: productCounts,
                backgroundColor: '#78A7F5',
                borderColor: '#5489DF',
                borderWidth: 1,
                borderRadius: 7
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },

            plugins: {
                legend: {
                    display: false
                }
            }
        }

    });


    // GRAFIK KONDISI STOK
    new Chart(document.getElementById('stockChart'), {

        type: 'doughnut',

        data: {
            labels: [
                'Stok Menipis',
                'Stok Cukup',
                'Stok Banyak'
            ],

            datasets: [{
                data: stockStatus,
                backgroundColor: [
                    '#F5B75D',
                    '#79A9F5',
                    '#A68AE8'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',

            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }

    });


    // GRAFIK TOTAL STOK PER KATEGORI
    new Chart(document.getElementById('stockByCategoryChart'), {

        type: 'bar',

        data: {
            labels: categoryLabels,

            datasets: [{
                label: 'Total Unit Stok',
                data: stockTotals,
                backgroundColor: '#A995E8',
                borderColor: '#8973D1',
                borderWidth: 1,
                borderRadius: 7
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },

            plugins: {
                legend: {
                    display: false
                }
            }
        }

    });

</script>
@endpush
