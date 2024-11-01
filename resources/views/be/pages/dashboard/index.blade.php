@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Dashboard - Coffe Shop</title>
    <meta content="Halaman Dashboard Coffe Shop" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="Coffe Shop" name="keywords">
@endpush
@push('custom-css')
    {{-- <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/be/css/datatables.min.css') }}" />
@endpush
{{-- @push('breadcrumb')
    <div class="card card-body py-3">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex justify-space-between">
                    <h4 class="card-title">Dashboard</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item d-flex">
                                <a class="text-muted text-decoration-none d-flex" href="{{ route('be.dashboard') }}">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Dashboard
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endpush --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('be.layouts.app_session')
            <div class="card">
                <div class="card-body pt-21 pb-md-1">
                    <div class="row flex-nowraap">
                        <div class="col-md-4 col-lg-3">
                            <div class="card border">
                                <div class="card-body text-center px-9 pb-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center round-48 rounded text-bg-info flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="solar:layers-minimalistic-linear" width="1.5em"
                                            height="1.5em"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Jumlah Menu</h6>
                                    <h4 class="mb-3 mt-2 d-flex align-items-center justify-content-center gap-1">
                                        {{ number_format($totalMenu, 0, '.', '.') }}</h4>
                                    <a href="{{ route('be.menu.list') }}"
                                        class="btn btn-info fs-2 fw-semibold text-nowrap">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card border">
                                <div class="card-body text-center px-9 pb-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="solar:users-group-rounded-linear" width="1.5em"
                                            height="1.5em"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Jumlah Petugas</h6>
                                    <h4 class="mb-3 mt-2 d-flex align-items-center justify-content-center gap-1">
                                        {{ number_format($totalPetugas, 0, '.', '.') }}</h4>
                                    <a href="{{ route('be.petugas.list') }}"
                                        class="btn btn-danger fs-2 fw-semibold text-nowrap">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card border">
                                <div class="card-body text-center px-9 pb-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="solar:dollar-minimalistic-linear" width="1.5em"
                                            height="1.5em"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Total Transaksi</h6>
                                    <h4 class="mb-3 mt-2 d-flex align-items-center justify-content-center gap-1">
                                        {{ number_format($totalTransaksi, 0, '.', '.') }}</h4>
                                    <a href="{{ route('be.transaksi.list') }}"
                                        class="btn btn-primary fs-2 fw-semibold text-nowrap">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="card border">
                                <div class="card-body text-center px-9 pb-4">
                                    <div
                                        class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="solar:graph-up-outline" width="1.5em"
                                            height="1.5em"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Pendapatan</h6>
                                    <h4 class="mb-3 mt-2 d-flex align-items-center justify-content-center gap-1">
                                        Rp {{ number_format($pendapatan, 0, '.', '.') }}</h4>
                                    <p>Bulan Ini</p>
                                    {{-- <a href="" class="btn btn-white fs-2 fw-semibold text-nowrap">Lihat
                                    Detail</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/js/datatables.min.js') }}"></script>
@endpush
