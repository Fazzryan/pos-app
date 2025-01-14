<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <header style="text-align: center;">
        <h1>Nettare Juice Bar</h1>
        <p>Jl. Dewi Sartika No.13, Tawangsari, Kecamatan Tawang, Kabupaten Tasikmalaya, Jawa Barat</p>
        <hr>
        <h2>Laporan Penjualan</h2>
        @if ($startDate && $endDate)
            <p>Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} s/d
                {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</p>
        @else
            <p>Periode: Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
        @endif
        <div>Total Pendapatan:
            <span style="font-weight: 600;"> Rp{{ number_format($pendapatanBlnSkrng, 0, ',', '.') }}</span>
        </div>
    </header>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nama Menu</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekapPenjualan as $key => $rekap)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($rekap->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ $rekap->nm_menu }}</td>
                    <td>{{ $rekap->jumlah }}</td>
                    <td>Rp {{ number_format($rekap->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($rekap->total_penjualan, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Otomatis cetak halaman
            window.print();

            // Tunggu hingga cetak selesai
            window.onafterprint = function() {
                // Tunggu 5 detik sebelum menutup halaman
                setTimeout(function() {
                    window.close();
                }, 1000);
            };
        });
    </script>

</body>

</html>
