@extends('be.layouts.app_main')
@push('meta-seo')
    <title>Transaksi - Coffe Shop</title>
    <meta content="Halaman Transaksi Coffe Shop" name="description">
    <meta content="Dinda Fazryan" name="author">
    <meta content="Coffe Shop" name="keywords">
@endpush
@push('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/be/css/datatables.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('vendor/flasher/flasher.min.css') }}"> --}}
@endpush
@push('breadcrumb')
    <div class="card card-body py-3">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex justify-space-between">
                    <h4 class="card-title">Transaksi</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item d-flex">
                                <a class="text-muted text-decoration-none d-flex" href="{{ route('be.dashboard') }}">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Transaksi
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
    <div class="row g">
        <div class="col-md-7 col-lg-6">
            <div class="card p-2">
                <div class="table-responsive">
                    <table id="tableMenu" class="table table-bordered rounded-1">
                        <thead>
                            <tr>
                                <th class="text-dark text-start" width="1">Foto</th>
                                <th class="text-dark text-start">Nama
                                </th>
                                <th class="text-dark text-start">Harga</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $item)
                                <tr class="align-middle">
                                    <td class="text-dark text-start">
                                        <img src="{{ asset('assets/be/images/menu/' . $item->foto) }}" alt="logo"
                                            class="bg-light rounded-1"
                                            style="width:70px; aspect-ratio:16/10; object-fit:cover;">
                                    </td>
                                    <td class="text-dark text-start">{{ $item->nm_menu }}</td>
                                    <td class="text-dark text-start">Rp {{ number_format($item->harga, 0, '.', '.') }}
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-sm btn-success d-flex align-items-center ms-1 py-2"
                                            onclick="addToKeranjang({{ $item->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <path stroke-linecap="round" d="M15 12h-3m0 0H9m3 0V9m0 3v3" />
                                                </g>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-6">
            <div class="table-responsive rounded-1">
                <table id="tableKeranjang" class="table w-100">
                    <thead>
                        <th class="text-dark text-start" width="5">No</th>
                        <th class="text-dark text-start">id</th>
                        <th class="text-dark text-start">Menu</th>
                        <th class="text-dark text-start">Qty</th>
                        <th class="text-dark text-start">Total</th>
                        <th class="text-dark text-start">Aksi</th>
                    </thead>
                    <tbody>
                        {{-- <tr class="align-middle">
                            <td>1</td>
                            <td>Es Cincau</td>
                            <td width="150">
                                <input type="number" min="1" max="100" value="1" class="form-control">
                            </td>
                            <td>Rp 10.000</td>
                            <td>
                                <button class="btn btn-sm btn-danger d-flex align-items-center py-2">
                                    <iconify-icon icon="solar:trash-bin-2-bold" width="1.2em"
                                        height="1.2em"></iconify-icon>
                                </button>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                <button type="button" class="btn btn-success fw-semibold w-100" data-bs-toggle="modal"
                    data-bs-target="#addTransaksi">Bayar Rp <span id="inv-total_transaksi"
                        class="total-text"></span></button>
            </div>
        </div>
    </div>

    {{-- modal transaksi --}}
    <div class="modal fade" tabindex="-1" id="addTransaksi" tabindex="-1" aria-labelledby="addTransaksiLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title text-dark">Pembayaran Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-transaksi">
                    @csrf
                    {{-- Inputan --}}
                    <input type="hidden" id="add-tgl_trans" name="tgl_trans" value="{{ date('Y-m-d') }}">
                    <input type="hidden" id="add-jam" name="jam" value="{{ date('H:i:s') }}">
                    <input type="hidden" id="add-list_menu" name="list_menu">
                    <input type="hidden" id="add-user_id" name="user_id"
                        value="{{ Session::get('user_session')['user_id'] }}">
                    <div class="modal-body">
                        <div id="alert_notif"> </div>
                        {{-- Nama pelanggan --}}
                        <div class="row align-items-center mb-2">
                            <div class="col-md-5">
                                <label for="add-nm_pelanggan" class="form-label">Nama Pelanggan</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="add-nm_pelanggan" name="nm_pelanggan"
                                    value="">
                            </div>
                        </div>
                        {{-- total transaksi --}}
                        <div class="row align-items-center mb-2">
                            <div class="col-md-5">
                                <label for="add-total_trans" class="form-label">Total Transaksi</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="add-total_trans" name="total_trans"
                                    value="" readonly>
                            </div>
                        </div>
                        {{-- total Bayar --}}
                        <div class="row align-items-center mb-2">
                            <div class="col-md-5">
                                <label for="add-total_bayar" class="form-label">Total Bayar</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" inputmode="numeric" class="form-control" id="add-total_bayar"
                                    name="total_bayar" value="0">
                            </div>
                        </div>
                        {{-- Kembalian --}}
                        <div class="row align-items-center mb-2">
                            <div class="col-md-5">
                                <label for="add-kembalian" class="form-label">Total Kembalian</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="add-kembalian" name="kembalian"
                                    value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn bg-danger-subtle text-danger"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="button" onclick="simpanBayar()" id="simpan_bayarr"
                            class="btn btn-success fw-semibold">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <button type="button" class="btn btn-success fw-semibold w-100" data-bs-toggle="modal"
        data-bs-target="#modalTransaksiSukses">tetsts></button> --}}
    <!-- Modal untuk menampilkan detail transaksi -->
    <div class="modal fade" id="modalTransaksiSukses" tabindex="-1" role="dialog"
        aria-labelledby="modalLabelTransaksiSukses" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modalLabelTransaksiSukses">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center my-3">
                        <div class="col-md-8 text-center">
                            <img src="{{ asset('assets/be/images/payment/transsuccess.svg') }}" class="w-75"
                                alt="logo">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h4 class="text-center mb-3">Transaksi Sukses!</h4>
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bolder">Atas Nama</h6>
                                <div class="text-dark">
                                    <span id="namaPelanggan" class="fw-normal"></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bolder">Total Transaksi</h6>
                                <span id="totalTransaksi" class="fw-normal text-dark"></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bolder">Total Bayar</h6>
                                <span id="totalBayar" class="fw-normal text-dark"></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bolder">Kembalian</h6>
                                <span id="kembalian" class="fw-normal text-dark"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary d-flex align-items-center" id="btnCetakNota">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" class="me-1"
                            viewBox="0 0 24 24">
                            <g fill="none">
                                <path stroke="currentColor" stroke-width="2.1"
                                    d="M6 17.983c-1.553-.047-2.48-.22-3.121-.862C2 16.243 2 14.828 2 12s0-4.243.879-5.121C3.757 6 5.172 6 8 6h8c2.828 0 4.243 0 5.121.879C22 7.757 22 9.172 22 12s0 4.243-.879 5.121c-.641.642-1.567.815-3.121.862" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 10H6m13 4H5" />
                                <path fill="currentColor"
                                    d="m17.121 2.879l-.53.53zm-10.242 0l.53.53zm0 18.242l.53-.53zM18.75 14a.75.75 0 0 0-1.5 0zm-12 0a.75.75 0 0 0-1.5 0zm10.5 2c0 1.435-.002 2.436-.103 3.192c-.099.734-.28 1.122-.556 1.399l1.06 1.06c.603-.601.861-1.36.983-2.26c.118-.878.116-1.998.116-3.391zM12 22.75c1.393 0 2.513.002 3.392-.116c.9-.122 1.658-.38 2.26-.982L16.59 20.59c-.277.277-.665.457-1.4.556c-.755.101-1.756.103-3.191.103zm0-20c1.435 0 2.437.002 3.192.103c.734.099 1.122.28 1.399.556l1.06-1.06c-.601-.603-1.36-.861-2.26-.982c-.878-.119-1.998-.117-3.391-.117zm0-1.5c-1.393 0-2.513-.002-3.392.117c-.9.12-1.658.38-2.26.981L7.41 3.41c.277-.277.665-.457 1.4-.556c.754-.101 1.756-.103 3.191-.103zM5.25 16c0 1.393-.002 2.513.117 3.392c.12.9.38 1.658.981 2.26L7.41 20.59c-.277-.277-.457-.665-.556-1.4c-.101-.755-.103-1.756-.103-3.191zM12 21.25c-1.435 0-2.437-.002-3.192-.103c-.734-.099-1.122-.28-1.399-.556l-1.06 1.06c.601.603 1.36.861 2.26.983c.878.118 1.998.116 3.391.116zm6.732-15.273c-.046-1.542-.208-2.757-1.08-3.629L16.59 3.41c.41.41.595 1.049.642 2.614zm-11.965.046c.047-1.565.231-2.203.642-2.614l-1.06-1.06c-.873.871-1.035 2.086-1.081 3.628zM18.75 16v-2h-1.5v2zm-12 0v-2h-1.5v2z" />
                                <circle cx="17" cy="10" r="1" fill="currentColor" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M15 16.5H9m4 2.5H9" />
                            </g>
                        </svg>
                        Cetak Nota
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/be/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/be/js/rupiah.js') }}"></script>

    <script>
        $("#tableMenu").DataTable();
        $("#tableKeranjang").DataTable({
            columnDefs: [{
                target: 1,
                visible: false,
            }],
            paginate: false,
            dom: '<"top">rt<"bottom"><"clear">'
        });

        var buka_notif_failed =
            "<div class='alert alert-danger alert-dismissible border-0 fade show' role='alert'>";
        var buka_notif_success =
            "<div class='alert alert-success alert-dismissible border-0 fade show' role='alert'>";
        var tutup_notif =
            "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

        let total_bayar = document.getElementById("add-total_bayar");
        total_bayar.addEventListener('keyup', function() {
            total_bayar.value = formatRupiah(this.value, "Rp. ");
            cekKembalian();
        });
    </script>

    <script>
        // fungsi tambah keranjang
        function addToKeranjang(id) {
            var list_transaksi = $('#add-list_menu').val();

            // Cari tombol yang diklik berdasarkan ID
            var row = $('button[onclick="addToKeranjang(' + id + ')"]').closest('tr');

            // Ambil data dari kolom di baris yang terkait
            var namaMenu = row.find('td:nth-child(2)').text(); // Nama menu
            var hargaText = row.find('td:nth-child(3)').text(); // Harga
            var harga = parseInt(hargaText.replace(/[Rp.,\s]/g, ''));
            // Debug: tampilkan data di console
            // console.log("ID Item: " + id);
            // console.log("Nama Menu: " + namaMenu);
            // console.log("Harga: " + harga);

            // Lakukan sesuatu dengan data, misalnya menambahkan ke keranjang
            if (list_transaksi == "") {
                var data_baru = [{
                    'id': id,
                    'nama_menu': namaMenu,
                    'qty': "1",
                    'harga': harga,
                }];
                $('#add-list_menu').val(JSON.stringify(data_baru));
                updateKeranjang("update");
            } else {
                var arr_transaksi_list = JSON.parse(list_transaksi);
                var cek_data = inArrayId(id, arr_transaksi_list);
                if (cek_data == true) {
                    alert('menu sudah ada!');
                } else {
                    arr_transaksi_list.push({
                        'id': id,
                        'nama_menu': namaMenu,
                        'qty': "1",
                        'harga': harga,
                    });
                    $('#add-list_menu').val(JSON.stringify(arr_transaksi_list));
                    updateKeranjang("update");
                    // alert('menambah menu!');
                }
            }
            // Di sini Anda bisa membuat AJAX request atau memproses data lebih lanjut
        }
        // fungsi update keranjang
        function updateKeranjang(action) {
            if (action == "update") {
                var list_transaksi = $('#add-list_menu').val();
                var arr_transaksi_list = JSON.parse(list_transaksi);
                var arr_length = arr_transaksi_list.length;
                var no = 1;
                $('#tableKeranjang').DataTable().clear().draw();
                for (var i = 0; arr_length > i; i++) {
                    var rowNode = $('#tableKeranjang').DataTable().row.add([
                        no,
                        arr_transaksi_list[i].id,
                        arr_transaksi_list[i].nama_menu,
                        arr_transaksi_list[i].qty,
                        formatRupiah(arr_transaksi_list[i].harga, "Rp "),
                        '<button class="btn btn-sm btn-danger qty-input btn-delete d-flex align-items-center py-2"><iconify-icon icon="solar:trash-bin-2-bold" width="1.2em"height="1.2em"></iconify-icon></button>'
                    ]).draw().node();
                    $(rowNode).addClass('align-middle');
                    $(rowNode).find('td').eq(0).addClass('text-start');
                    $(rowNode).find('td').eq(1).addClass('text-start');
                    $(rowNode).find('td').eq(2).addClass('text-start');
                    $(rowNode).find('td').eq(3).addClass('text-start');
                    $(rowNode).find('td').eq(4).addClass('text-center');
                    no++;
                }
                cariTotalTransaksi();
            } else if (action == "delete") {
                var form_data = $('#tableKeranjang').DataTable().rows().data().toArray();
                var arr_length = form_data.length;

                if (arr_length == 0) {
                    data_list = "";
                    $('#add-list_menu').val("");
                    cariTotalTransaksi();
                } else {
                    var no = 1;
                    var data_list = [];
                    for (var i = 0; arr_length > i; i++) {
                        var hrg_total = form_data[i][4].toString();

                        if (dotInString(hrg_total) == true) {
                            hrg_total = hrg_total.split('.').join("");
                        }
                        data_list.push({
                            'id': form_data[i][1],
                            'nama_menu': form_data[i][2],
                            'qty': form_data[i][3],
                            'harga': hrg_total,
                        });
                    }
                    $('#add-list_menu').val(JSON.stringify(data_list));
                    updateKeranjang("update");
                }
            }
        }
        // fungsi hapus keranjang
        $('#tableKeranjang').on('click', '.btn-delete', function() {
            var tbl = $('#tableKeranjang').DataTable();
            var row = $(this).parents('tr');

            if ($(row).hasClass('child')) {
                tbl.row($(row).prev('tr')).remove().draw();
                updateKeranjang("delete");
            } else {
                tbl.row($(this).parents('tr')).remove().draw();
                updateKeranjang("delete");
            }

        });
        // fungsi cari total transaksi
        function cariTotalTransaksi() {
            var btn_inv = document.getElementById("inv-total_transaksi");
            var input_inv = document.getElementById("add-total_trans");
            var list_transaksi = $('#add-list_menu').val();

            if (list_transaksi.length == 0) {
                btn_inv.innerText = "0";
                input_inv.value = "0";
            } else {
                var arr_transaksi_list = JSON.parse(list_transaksi);
                var arr_length = arr_transaksi_list.length;
                total_transaksi = 0;
                for (var i = 0; arr_length > i; i++) {
                    total_transaksi += parseInt(arr_transaksi_list[i].harga);
                }
                btn_inv.innerText = formatRupiah(total_transaksi.toString(), "Rp. ");
                input_inv.value = formatRupiah(total_transaksi.toString(), "Rp. ");
            }
        }
        // fungsi cek kembalian
        function cekKembalian() {
            let total_trans = $("#add-total_trans").val();
            let total_bayar = $("#add-total_bayar").val();

            if (dotInString(total_trans) == true) {
                total_trans = total_trans.split('.').join("");
            }
            if (dotInString(total_bayar) == true) {
                total_bayar = total_bayar.split('.').join("");
            }
            total_trans = parseInt(total_trans);
            total_bayar = parseInt(total_bayar);
            let kembalian = total_bayar - total_trans;
            kembalian = parseInt(kembalian);

            if (total_trans == 0) {
                $("#alert_notif").html(buka_notif_failed + "List masih kosong!" + tutup_notif);
                $('#add-total_bayar').val(0);
                $('#add-kembalian').html(0);
            } else if (kembalian < 0) {
                $('#add-kembalian').val(0);
            } else if (kembalian > 0) {
                $('#add-kembalian').val(formatRupiah(kembalian, 'Rp. '));
            }
        }
        // fungsi simpan pembayaran
        function simpanBayar() {
            let total_trans = $("#add-total_trans").val();
            let total_bayar = $("#add-total_bayar").val();
            let kembalian = $("#add-kembalian").val();
            let nm_pelanggan = $("#add-nm_pelanggan").val();

            if (dotInString(total_trans) == true) {
                total_trans = total_trans.split('.').join("");
            }
            if (dotInString(total_bayar) == true) {
                total_bayar = total_bayar.split('.').join("");
            }
            if (dotInString(kembalian) == true) {
                kembalian = kembalian.split('.').join("");
            }

            // Konversi nilai string menjadi angka
            total_trans = parseInt(total_trans);
            total_bayar = parseInt(total_bayar);
            kembalian = parseInt(kembalian);

            if (total_trans == 0) {
                $("#alert_notif").html(buka_notif_failed + "List masih kosong!" + tutup_notif);
                $("#add-total_bayar").val(0);
                $("#add-kembalian").val(0);
            } else if ((nm_pelanggan == "")) {
                $("#alert_notif").html(buka_notif_failed + "Nama Pelanggan harus di isi!" + tutup_notif);
            } else if ((total_bayar == "") || (total_bayar == 0)) {
                $("#alert_notif").html(buka_notif_failed + "Total bayar masih kosong!" + tutup_notif);
                $("#add-kembalian").val(0);
            } else if (total_bayar < total_trans) {
                $("#alert_notif").html(buka_notif_failed + "Total Bayar tidak cukup!" + tutup_notif);
            } else {
                let url = "{{ route('be.transaksi.act_add') }}";
                let values = $("#form-transaksi").serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: values,
                    success: function(response) {
                        if (response.status == 200) {
                            // Tampilkan modal setelah transaksi berhasil
                            $("#namaPelanggan").text(toCamelCase(response.data.nm_pelanggan));
                            $("#totalTransaksi").text(formatRupiah(response.data.total_trans, 'Rp. '));
                            $("#totalBayar").text(formatRupiah(response.data.total_bayar, 'Rp. '));
                            $("#kembalian").text(formatRupiah(response.data.kembalian, 'Rp. '));

                            // Set the onclick event for printing the nota
                            $('#btnCetakNota').attr('onclick', `cetakNota('${response.data.kd_trans}')`);

                            // Tampilkan modal
                            $('#addTransaksi').modal('hide');
                            $('#modalTransaksiSukses').modal('show');

                            // Reset form transaksi setelah sukses
                            $("#form-transaksi")[0].reset();
                            $("#add-list_menu").val("");
                            $('#tableKeranjang').DataTable().clear().draw();
                            $("#inv-total_transaksi").text("");
                        } else { // Tampilkan pesan error jika status bukan 200
                            let errorMessage = response.message ? response.message :
                                "Terjadi kesalahan, coba lagi.";
                            $("#alert_notif").html(buka_notif_failed + errorMessage + tutup_notif);

                        }
                    },
                    error: function(xhr) {
                        // Ambil pesan error dari response JSON
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                            xhr.responseJSON.message : "Terjadi kesalahan, coba lagi.";

                        // Tampilkan pesan error pada notifikasi
                        $("#alert_notif").html(buka_notif_failed + errorMessage + tutup_notif);
                        $("#add-total_bayar").val(0);
                        $("#add-kembalian").val(0);
                        // Untuk debug, tampilkan detail error di console
                        console.log(xhr.responseText);
                    }
                });
            }
        }

        // fungsi cetak nota
        function cetakNota(kd_trans) {
            // Membuka halaman cetak nota di tab baru
            let url = "{{ route('be.riwayat.cetak_nota') }}" + "/" + kd_trans;
            window.open(url, '_blank');
        }
        // fungsi tambahan
        // Event listener untuk perubahan nilai input qty
        $('#tableKeranjang tbody').on('click', 'td', function() {
            var tbl = $('#tableKeranjang').DataTable();
            var cell = tbl.cell(this);
            var colIndexClicked = cell.index().column;

            var tr = event.target.closest('tr');
            var row = tbl.row(tr);
            var rowdata = row.data();

            if (colIndexClicked === 3) {
                var id = rowdata[1]
                var nama_menu = rowdata[2];
                var oldValue = parseInt(rowdata[3]);
                var harga = rowdata[4];

                if (dotInString(harga) == true) {
                    harga = harga.split('.').join("");
                }
                var harga_satuan = parseInt(harga) / oldValue;

                var input = $('<input>', {
                    type: 'text',
                    value: oldValue,
                    class: 'form-control edt-hrgjmlbarang',
                    id: 'edt-kolom',
                    inputmode: 'numeric' // hanya angka pada mobile
                });

                //ketika user klik cursor diluar area table
                input.on('blur', function() {
                    var newValue = $(this).val().split('.').join("");
                    var qty = 0;
                    if ($.isNumeric(newValue)) { // Memastikan bahwa hanya angka yang diterima
                        if (colIndexClicked === 3) {
                            qty = newValue;
                            var harga_akhir = qty * harga_satuan;

                            tbl.cell({
                                row: row.index(),
                                column: colIndexClicked
                            }).data(qty).draw();

                            tbl.cell({
                                row: row.index(),
                                column: 4
                            }).data(harga_akhir).draw();
                            updateKeranjang("delete");
                        }
                    } else {
                        cell.data(oldValue).draw(); // Kembalikan nilai lama
                    }
                });

                // Hanya terima angka
                input.on('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, ''); // Hapus karakter non-angka
                });

                input.on("keyup change", function() {
                    var edt_data = document.getElementById("edt-kolom");
                    edt_data.value = this.value;
                });

                $(this).html(input);
                input.focus();
                input[0].setSelectionRange(oldValue.length, oldValue.length); // Tempatkan kursor di akhir nilai
            }
        });
        // fungsi untuk mengecek id dalama array
        function inArrayId(id, arr) {
            for (var i = 0; i < arr.length; i++) {
                if (arr[i].id == id) {
                    return true; // ID ditemukan
                }
            }
            return false; // ID tidak ditemukan
        }

        function dotInString(str) {
            if (str.includes('.')) {
                return true;
            } else {
                return false;
            }
        }

        function toCamelCase(str) {
            return str.toLowerCase().replace(/\b(\w)/g, function(match) {
                return match.toUpperCase();
            });
        }
    </script>
@endpush
