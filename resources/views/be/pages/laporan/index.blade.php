@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Laporan - Coffe Shop</title>
    <meta content="Halaman Dashboard Coffe Shop" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="Coffe Shop" name="keywords">
@endpush

@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/be/css/datatables.min.css') }}" />
@endpush

@push('breadcrumb')
    <div class="card card-body py-3">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex justify-space-between">
                    <h4 class="card-title">Laporan</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item d-flex">
                                <a class="text-muted text-decoration-none d-flex" href="{{ route('be.dashboard') }}">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Laporan
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <div class="row">
        @include('be.layouts.app_session')
        <div class="col-md-12">
            <div class="card bg-white border">
                <div class="card-header text-white fw-semibold bg-danger text-center">
                    Filter Laporan Penjualan
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('be.laporan.list') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon3">Tanggal Awal</span>
                                    <input type="date" name="startDate" id="startDate" class="form-control"
                                        value="{{ request()->startDate }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon3">Tanggal Akhir</span>
                                    <input type="date" name="endDate" id="endDate" class="form-control"
                                        value="{{ request()->endDate }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center gap-2">
                                    <button type="submit" class="btn btn-danger bg-gradient">Terapkan Filter</button>
                                    <a href="{{ route('be.laporan.list') }}" class="btn btn-dark bg-gradient">Reset
                                        Filter</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card h-100 bg-white border mb-3">
                <div class="card-header text-white fw-semibold bg-success text-center">Total Pendapatan Bulanan</div>
                <div class="card-body text-center">
                    <h5 class="card-title">Rp {{ number_format($pendapatanBlnSkrng, 0, '.', '.') }}</h5>
                    <p class="card-text">Pendapatan perbulan berdasarkan data transaksi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 bg-white border mb-3">
                <div class="card-header text-white fw-semibold bg-success text-center">Total Transaksi Bulanan</div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ number_format($totalTransBlnSkrng, 0, '.', '.') }} Transaksi</h5>
                    <p class="card-text">Jumlah transaksi yang dilakukan perbulan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border">
                <div class="card-header text-white fw-semibold bg-primary text-center">
                    Laporan Penjualan Produk
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablePenjualanProduk" class="table table-bordered">
                            <thead>
                                <th class="text-dark text-start">#</th>
                                <th class="text-dark text-start">Tanggal</th>
                                <th class="text-dark text-start">Nama Menu</th>
                                <th class="text-dark text-start">Jumlah</th>
                                <th class="text-dark text-start">Harga</th>
                                <th class="text-dark text-start">Total Pemasukan</th>
                            </thead>
                            <tbody>
                                @foreach ($rekapPenjualan as $key => $rekap)
                                    <tr>
                                        <td class="text-dark text-start">{{ $key + 1 }}</td>
                                        <td class="text-dark text-start">{{ $rekap->tanggal }}</td>
                                        <td class="text-dark text-start">{{ $rekap->nm_menu }}</td>
                                        <td class="text-dark text-start">{{ $rekap->jumlah }}</td>
                                        <td class="text-dark text-start">Rp {{ number_format($rekap->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="text-dark text-start">
                                            Rp {{ number_format($rekap->total_penjualan, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('be.laporan.cetakLaporan', ['startDate' => request('startDate'), 'endDate' => request('endDate')]) }}"
                        target="_blank" class="btn btn-primary bg-gradient mt-3">Cetak
                        Laporan</a>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-12">
            <div class="card border">
                <div class="card-header bg-primary p-">
                    <h6 class="card-title text-white fw-semibold">Laporan Penjualan Produk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablePenjualanProduk" class="table table-bordered">
                            <thead>
                                <th class="text-dark text-start">#</th>
                                <th class="text-dark text-start">Nama Menu</th>
                                <th class="text-dark text-start">Sisa Stok</th>
                                <th class="text-dark text-start">Jumlah Terjual</th>
                                <th class="text-dark text-start">Harga Satuan</th>
                                <th class="text-dark text-start">Total Pemasukan</th>
                            </thead>
                            <tbody>
                                @foreach ($arrList as $key => $item)
                                    <tr>
                                        <td class="text-dark text-start">{{ $key + 1 }}</td>
                                        <td class="text-dark text-start">{{ $item['nm_menu'] }}</td>
                                        <td class="text-dark text-start">{{ $item['stok'] }}</td>
                                        <td class="text-dark text-start">{{ $item['qty'] }}</td>
                                        <td class="text-dark text-start">Rp
                                            {{ number_format($item['harga'], 0, '.', '.') }}
                                        </td>
                                        <td class="text-dark text-start">Rp
                                            {{ number_format($item['total_harga'], 0, '.', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#tablePenjualanProduk").DataTable({
                language: {
                    emptyTable: "Tidak ada data untuk ditampilkan."
                }
            });
        });
    </script>
@endpush
