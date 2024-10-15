@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Laporan - Coffe Shop</title>
    <meta content="Halaman Dashboard Coffe Shop" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="Coffe Shop" name="keywords">
@endpush
@push('custom-css')
    {{-- <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}"> --}}
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
        <div class="col-md-12">
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
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/js/datatables.min.js') }}"></script>
    <script>
        $("#tablePenjualanProduk").DataTable();
    </script>
@endpush
