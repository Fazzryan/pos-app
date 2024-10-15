@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Petugas - Coffe Shop</title>
    <meta content="Halaman Petugas Coffe Shop" name="description">
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
                    <h4 class="card-title">Petugas</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb  mb-0">
                            <li class="breadcrumb-item d-flex">
                                <a class="text-muted text-decoration-none d-flex" href="{{ route('be.dashboard') }}">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Petugas
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
                    <div class="mb-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#tambahPetugas"
                            class="btn btn-primary fw-semibold">Tambah Petugas</button>
                    </div>
                    <div class="table-responsive">
                        <table id="tablePetugas" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-dark text-start" width="1">#</th>
                                    <th class="text-dark text-start">Nama Petugas</th>
                                    <th class="text-dark text-start">Telepon</th>
                                    <th class="text-dark text-start">Jenis Kelamin</th>
                                    <th class="text-dark text-start">Autentikasi</th>
                                    <th class="text-dark">
                                        <div class="d-flex align-items-center">
                                            <iconify-icon icon="solar:settings-broken" width="1.2em"
                                                height="1.2em"></iconify-icon>
                                            <span class="ms-1">Action</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petugas as $key => $item)
                                    <tr class="align-middle">
                                        <td class="text-dark text-start">{{ $key + 1 }}</td>
                                        <td class="text-dark text-start">{{ $item->nm_lengkap }}</td>
                                        <td class="text-dark text-start">{{ $item->nohp }}</td>
                                        <td class="text-dark text-start">{{ $item->jk }}</td>
                                        <td class="text-dark text-start">
                                            <button type="button"
                                                class="btn btn-sm btn-success d-flex align-items-center py-2"
                                                data-bs-toggle="modal" data-bs-target="#lihatAuth"
                                                onclick="showAuth({{ $item->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M9.75 12a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0" />
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M2 12c0 1.64.425 2.191 1.275 3.296C4.972 17.5 7.818 20 12 20s7.028-2.5 8.725-4.704C21.575 14.192 22 13.639 22 12c0-1.64-.425-2.191-1.275-3.296C19.028 6.5 16.182 4 12 4S4.972 6.5 3.275 8.704C2.425 9.81 2 10.361 2 12m10-3.75a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <button type="button"
                                                    class="btn btn-sm btn-primary d-flex align-items-center py-2"
                                                    data-bs-toggle="modal" data-bs-target="#editPetugas"
                                                    onclick="editPetugas({{ $item->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                        viewBox="0 0 24 24">
                                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="2.2">
                                                            <path
                                                                d="M2 12c0 4.714 0 7.071 1.464 8.535C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465C22 19.072 22 16.714 22 12v-1.5M13.5 2H12C7.286 2 4.929 2 3.464 3.464c-.973.974-1.3 2.343-1.409 4.536" />
                                                            <path
                                                                d="m16.652 3.455l.649-.649A2.753 2.753 0 0 1 21.194 6.7l-.65.649m-3.892-3.893s.081 1.379 1.298 2.595c1.216 1.217 2.595 1.298 2.595 1.298m-3.893-3.893L10.687 9.42c-.404.404-.606.606-.78.829q-.308.395-.524.848c-.121.255-.211.526-.392 1.068L8.412 13.9m12.133-6.552l-2.983 2.982m-2.982 2.983c-.404.404-.606.606-.829.78a4.6 4.6 0 0 1-.848.524c-.255.121-.526.211-1.068.392l-1.735.579m0 0l-1.123.374a.742.742 0 0 1-.939-.94l.374-1.122m1.688 1.688L8.412 13.9" />
                                                        </g>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center ms-1 py-2"
                                                    data-bs-toggle="modal" data-bs-target="#hapusPetugas"
                                                    onclick="hapusPetugas({{ $item->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                        viewBox="0 0 24 24">
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="2.2"
                                                            d="M20.5 6h-17m5.67-2a3.001 3.001 0 0 1 5.66 0m3.544 11.4c-.177 2.654-.266 3.981-1.131 4.79s-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9m13.666 0l-.2 3" />
                                                    </svg>
                                                </button>
                                            </div>
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

    {{-- Modal add --}}
    <div class="modal fade" tabindex="-1" id="tambahPetugas" tabindex="-1" aria-labelledby="tambahPetugasLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Tambah Data Petugas</h5>

                </div>
                <form action="{{ route('be.petugas.act_add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Silahkan sesuaikan dengan data anda.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="add-nm_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="add-nm_lengkap" name="nm_lengkap"
                                        value="{{ old('nm_lengkap') }}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="add-nohp" class="form-label">Telepon</label>
                                        <input type="number" class="form-control" id="add-nohp" name="nohp"
                                            value="{{ old('nohp') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="add-jk" class="form-label">Jenis Kelamin</label>
                                        <select name="jk" id="add-jk" class="form-select">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="add-alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="add-alamat" name="alamat"
                                        value="{{ old('alamat') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="add-username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="add-username" name="username"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="add-password" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="add-password" name="password"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="add-role" class="form-label">Role</label>
                                    <select name="role" id="add-role" class="form-select">
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn bg-danger-subtle text-danger"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-semibold">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal lihat auth --}}
    <div class="modal fade" tabindex="-1" id="lihatAuth" tabindex="-1" aria-labelledby="lihatAuthLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Data Autentikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.petugas.act_edit_auth') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Silahkan sesuaikan dengan data anda.</p>
                        <input type="hidden" id="shw-user_id" name="user_id" value="">
                        <div class="mb-3">
                            <label for="shw-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="shw-username" name="username"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="shw-password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="shw-password" name="password"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="shw-role" class="form-label">Role</label>
                            <select name="role" id="shw-role" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-outline-light border text-dark"
                            data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary fw-semibold">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" tabindex="-1" id="editPetugas" tabindex="-1" aria-labelledby="editPetugasLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Data Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.petugas.act_edit') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Silahkan sesuaikan dengan data anda.</p>
                        <input type="hidden" id="edt-user_id" name="user_id" value="">
                        <div class="mb-3">
                            <label for="edt-nm_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edt-nm_lengkap" name="nm_lengkap"
                                value="">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edt-nohp" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="edt-nohp" name="nohp"
                                    value="">
                            </div>
                            <div class="col-md-6">
                                <label for="edt-jk" class="form-label">Jenis Kelamin</label>
                                <select name="jk" id="edt-jk" class="form-select">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edt-alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="edt-alamat" name="alamat" value="">
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn bg-danger-subtle text-danger"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-semibold">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus petugas --}}
    <div class="modal fade" tabindex="-1" id="hapusPetugas" tabindex="-1" aria-labelledby="hapusPetugasLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Hapus Menu?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.petugas.act_delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="del-petugas_id" name="petugas_id" value="">
                        <p class="text-dark">Apakah anda yakin ingin menghapus petugas ini? Setelah dihapus, data tidak
                            dapat
                            dikembalikan.</p>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-outline-light border text-dark"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger fw-semibold">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/js/datatables.min.js') }}"></script>
    <script>
        $('#tablePetugas').DataTable();
    </script>
    <script>
        function showAuth(id) {
            @foreach ($petugas as $val_petugas)
                if (id == "{{ $val_petugas->user_id }}") {
                    $("#shw-user_id").val("{{ $val_petugas->user_id }}");
                    $("#shw-username").val("{{ $val_petugas->username }}");
                    $("#shw-password").val("{{ $val_petugas->pass }}");
                    $("#shw-role").val("{{ $val_petugas->role }}");
                }
            @endforeach
        }

        function editPetugas(id) {
            @foreach ($petugas as $val)
                if (id == "{{ $val->id }}") {
                    $("#edt-user_id").val("{{ $val->user_id }}");
                    $("#edt-nm_lengkap").val("{{ $val->nm_lengkap }}");
                    $("#edt-nohp").val("{{ $val->nohp }}");
                    $("#edt-jk").val("{{ $val->jk }}");
                    $("#edt-alamat").val("{{ $val->alamat }}");
                }
            @endforeach
        }

        function hapusPetugas(id) {
            $("#del-petugas_id").val(id);
        }
    </script>
@endpush
