@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Profile Petugas - Coffe Shop</title>
    <meta content="Halaman Profile Petugas Coffe Shop" name="description">
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
                    <h4 class="card-title">Profile Petugas</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb  mb-0">
                            <li class="breadcrumb-item d-flex">
                                <a class="text-muted text-decoration-none d-flex" href="{{ route('be.dashboard') }}">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Profile Petugas
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
            @include('be.layouts.app_session')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('be.petugas.act_edit') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <label for="edt-nm_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="edt-nm_lengkap" name="nm_lengkap"
                                                value="{{ $user->nm_lengkap }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edt-nohp" class="form-label">Telepon</label>
                                            <input type="number" class="form-control" id="edt-nohp" name="nohp"
                                                value="{{ $user->nohp }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edt-jk" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" name="jk" id="edt-jk">
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edt-alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="edt-alamat" name="alamat"
                                                value="{{ $user->alamat }}" required>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary fw-semibold">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#edt-jk").val("{{ $user->jk }}");
    </script>
@endpush
