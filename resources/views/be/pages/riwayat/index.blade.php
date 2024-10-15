@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Riwayat Transaksi - Coffe Shop</title>
    <meta content="Halaman Riwayat Transaksi Coffe Shop" name="description">
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
                    <h4 class="card-title">Riwayat Transaksi</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item d-flex">
                                <a class="text-muted text-decoration-none d-flex" href="{{ route('be.dashboard') }}">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Riwayat Transaksi
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
                <div class="card-body mb-1">
                    <div class="table-responsive">
                        <table id="tableRiwayat" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-dark text-start" width="1">#</th>
                                    <th class="text-dark text-start">Kode Transaksi</th>
                                    <th class="text-dark text-start">Tgl Transaksi</th>
                                    <th class="text-dark text-start">List Menu</th>
                                    <th class="text-dark text-start">Total Harga</th>
                                    <th class="text-dark text-start">Bayar</th>
                                    <th class="text-dark text-start">Kembalian</th>
                                    <th class="text-dark text-start">Kasir</th>
                                    <th class="text-dark">
                                        <div class="d-flex align-items-center">
                                            <iconify-icon icon="solar:settings-broken" width="1.2em"
                                                height="1.2em"></iconify-icon>
                                            <span class="ms-1">Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getTransaksi as $key=> $item)
                                    <tr class="align-middle">
                                        <td class="text-dark text-start">{{ $key + 1 }}</td>
                                        <td class="text-dark text-start">{{ $item->kd_trans }}</td>
                                        <td class="text-dark text-start">
                                            {{ \Carbon\Carbon::parse($item->tgl_trans)->translatedFormat('d F Y') }}</td>
                                        <td class="text-dark text-start">
                                            <button type="button"
                                                class="btn btn-sm btn-success d-flex align-items-center py-2"
                                                data-bs-toggle="modal" data-bs-target="#listMenu"
                                                onclick="showListMenu('{{ $item->kd_trans }}')">
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
                                        <td class="text-dark text-start">Rp
                                            {{ number_format($item->total_trans, 0, '.', '.') }}
                                        </td>
                                        <td class="text-dark text-start"> Rp
                                            {{ number_format($item->total_bayar, 0, '.', '.') }}
                                        </td>
                                        <td class="text-dark text-start"> Rp
                                            {{ number_format($item->kembalian, 0, '.', '.') }}
                                        </td>
                                        <td class="text-dark text-start">{{ $item->nm_lengkap }}</td>
                                        <td class="text-dark text-start">
                                            <div class="d-flex align-items-center">
                                                <button type="button"
                                                    class="btn btn-sm btn-primary d-flex align-items-center ms-1 py-2"
                                                    onclick="printNota('{{ $item->kd_trans }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                        viewBox="0 0 24 24">
                                                        <g fill="none">
                                                            <path stroke="currentColor" stroke-width="2"
                                                                d="M6 17.983c-1.553-.047-2.48-.22-3.121-.862C2 16.243 2 14.828 2 12s0-4.243.879-5.121C3.757 6 5.172 6 8 6h8c2.828 0 4.243 0 5.121.879C22 7.757 22 9.172 22 12s0 4.243-.879 5.121c-.641.642-1.567.815-3.121.862" />
                                                            <path fill="currentColor"
                                                                d="m17.121 2.879l-.53.53zm-10.242 0l.53.53zm0 18.242l.53-.53zM18.75 12a.75.75 0 0 0-1.5 0zm-12 0a.75.75 0 0 0-1.5 0zm10.5 4c0 1.435-.002 2.436-.103 3.192c-.099.734-.28 1.122-.556 1.399l1.06 1.06c.603-.601.861-1.36.983-2.26c.118-.878.116-1.998.116-3.391zM12 22.75c1.393 0 2.513.002 3.392-.116c.9-.122 1.658-.38 2.26-.982L16.59 20.59c-.277.277-.665.457-1.4.556c-.755.101-1.756.103-3.191.103zm0-20c1.435 0 2.437.002 3.192.103c.734.099 1.122.28 1.399.556l1.06-1.06c-.601-.603-1.36-.861-2.26-.982c-.878-.119-1.998-.117-3.391-.117zm0-1.5c-1.393 0-2.513-.002-3.392.117c-.9.12-1.658.38-2.26.981L7.41 3.41c.277-.277.665-.457 1.4-.556c.754-.101 1.756-.103 3.191-.103zM5.25 16c0 1.393-.002 2.513.117 3.392c.12.9.38 1.658.981 2.26L7.41 20.59c-.277-.277-.457-.665-.556-1.4c-.101-.755-.103-1.756-.103-3.191zM12 21.25c-1.435 0-2.437-.002-3.192-.103c-.734-.099-1.122-.28-1.399-.556l-1.06 1.06c.601.603 1.36.861 2.26.983c.878.118 1.998.116 3.391.116zm6.732-15.273c-.046-1.542-.208-2.757-1.08-3.629L16.59 3.41c.41.41.595 1.049.642 2.614zm-11.965.046c.047-1.565.231-2.203.642-2.614l-1.06-1.06c-.873.871-1.035 2.086-1.081 3.628zM18.75 16v-4h-1.5v4zm-12 0v-4h-1.5v4z" />
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-width="2"
                                                                d="M19.5 12.443C17.873 11.713 15.412 11 12 11s-5.873.713-7.5 1.443" />
                                                        </g>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center ms-1 py-2"
                                                    data-bs-toggle="modal" data-bs-target="#deleteTrans"
                                                    onclick="deleteTrans('{{ $item->kd_trans }}')">
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

    {{-- Modal list menu --}}
    <div class="modal fade" tabindex="-1" id="listMenu" tabindex="-1" aria-labelledby="listMenuLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">List Menu Yang Dibeli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tableListMenu" class="table table-bordered">
                            <thead>
                                <th class="text-dark text-start" width="1">#</th>
                                <th class="text-dark text-start">Kode Transaksi</th>
                                <th class="text-dark text-start">Menu</th>
                                <th class="text-dark text-start">Qty</th>
                                <th class="text-dark text-start">Harga</th>
                                <th class="text-dark text-start">Total</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-outline-light border text-dark"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal delete riwayat --}}
    <div class="modal fade" tabindex="-1" id="deleteTrans" tabindex="-1" aria-labelledby="deleteTransLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Hapus Data?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('be.riwayat.act_delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="del-kd_trans" name="kd_trans" value="">
                        <p class="text-dark">Apakah anda yakin ingin menghapus transaksi ini? Setelah dihapus, data tidak
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
    <script src="{{ asset('assets/be/js/rupiah.js') }}"></script>
    <script>
        $('#tableRiwayat').DataTable();
        $('#tableListMenu').DataTable();
    </script>
    <script>
        function showListMenu(kd_trans) {
            // Validasi di sisi client sebelum mengirimkan request
            if (!kd_trans || kd_trans.trim() === '') {
                alert("Kode transaksi tidak boleh kosong!");
                return false; // Hentikan eksekusi jika kd_trans kosong
            }

            let url = "{{ route('be.riwayat.get_list_menu') }}";
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    kd_trans: kd_trans
                },
                success: function(response) {
                    var result = response.data;
                    var status = response.status;
                    var msg = response.message;

                    if (response.status === "200") {
                        generateTableList(result);
                    } else {
                        console.log(response.message); // Kode transaksi tidak ditemukan
                    }
                },
                error: function(xhr) {
                    let stat = xhr.responseText;
                }
            });
        }

        function generateTableList(records) {
            $('#tableListMenu').DataTable().clear().draw();
            var arr_list = records;
            var no = 1;
            $.each(arr_list, function(index) {
                var kd_trans = arr_list[index].kd_trans;
                var nm_menu = arr_list[index].nm_menu;
                var qty = arr_list[index].qty;
                var harga = "Rp " + formatRupiah(arr_list[index].harga.toString(), 'Rp. ');
                var total_harga = "Rp " + formatRupiah(arr_list[index].total_harga.toString(), 'Rp. ');

                var rowNode = $('#tableListMenu').DataTable().row.add([
                    no, kd_trans, nm_menu, qty, harga, total_harga
                ]).draw().node();
                $(rowNode).find('td').eq(0).addClass('text-start text-dark');
                $(rowNode).find('td').eq(1).addClass('text-dark');
                $(rowNode).find('td').eq(2).addClass('text-dark');
                $(rowNode).find('td').eq(3).addClass('text-start text-dark');
                $(rowNode).find('td').eq(4).addClass('text-dark');
                $(rowNode).find('td').eq(5).addClass('text-dark');
                no++
            });
        }

        function printNota(kd_trans) {
            let url = "{{ route('be.riwayat.cetak_nota') }}" + "/" + kd_trans;
            window.open(url, '_blank');
        }

        function deleteTrans(kd_trans) {
            $("#del-kd_trans").val(kd_trans);
        }
    </script>
@endpush
