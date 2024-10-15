<html>

<head>
    <title>COFFE SHOP - Print Nota {{ $transaksi->kd_trans }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/be/images/logos/favicon.png') }}">

    <style>
        body {
            font-size: 11px;
            font-family: helvetica;
        }

        table {
            font-size: 11px;
        }

        .container {
            max-width: 200px;
        }

        header {
            text-align: center;
            margin: auto;
        }

        footer {
            width: 100%;
            text-align: center;
        }

        hr {
            margin: 10px 0;
            padding: 0;
            height: 1px;
            border: 0;
            border-bottom: 1px solid rgb(49, 49, 49);
            width: 100%;

        }

        .nama-item {
            font-weight: bold;
        }

        .harga-item {
            display: flex;
            justify-content: flex-end;
            margin: 0;
            padding: 0;
        }


        table {
            border-collapse: collapse;
        }

        table td {
            border: 0;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }

        .nama-perusahaan {
            font-weight: bold;
            font-size: 120%;
            margin-bottom: 3px;
        }
    </style>

</head>

<body onload="window.print()">
    <div class="container">

        <header>
            <div class="nama-perusahaan">COFFE SHOP</div>
            <div>Kp, Jl. Setiamulya, Sukasetia, Cisayong, Tasikmalaya Regency</div>
        </header>
        <hr />
        <div class="metadata">
            <table>
                <tr>
                    <td>Kode</td>
                    <td>:</td>
                    <td>{{ $transaksi->kd_trans }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tgl_trans)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Jam</td>
                    <td>:</td>
                    <td>{{ $transaksi->jam }}</td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>:</td>
                    <td>{{ $transaksi->nm_lengkap }}</td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td>:</td>
                    <td>{{ $transaksi->nm_pelanggan }}</td>
                </tr>
            </table>
        </div>
        <hr />
        <div class="item-container">
            <table width="100%">
                @foreach ($transaksiList as $list)
                    <tr>
                        <td colspan="4"><span class="nama-item">{{ $list->nm_menu }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width:3px;height:15px;">{{ $list->qty }}</td>
                        <td style="width:1px;height:15px;padding-left:2px">x</td>
                        <td style="width:5px;height:15px;padding-left:2px">
                            {{ number_format($list->harga, 0, ',', '.') }}</td>
                        <td class="text-right" style="width:50px;height:15px;padding-left:10px">
                            {{ number_format($list->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="height:5px;><span class="spasi"></span></td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4">
                        <hr />
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Total Transaksi</td>
                    <td class="text-right">{{ number_format($transaksi->total_trans, 0, ',', '.') }}</td>
                </tr>
                <tr class="text-bold">
                    <td colspan="3">Dibayar</td>
                    <td class="text-right">{{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                </tr>
                <tr class="text-bold">
                    <td colspan="3">Kembali</td>
                    <td class="text-right">{{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        <hr />
        <footer>
            Terima kasih telah berbelanja di tempat kami. Kepuasan Anda adalah tujuan kami.
            Kritik dan Saran
            <br>
            Call/Wa 0895-3938-76020
        </footer>
    </div>
</body>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(function() {
            window.close();
        }, 5000);

    });
</script>

</html>
