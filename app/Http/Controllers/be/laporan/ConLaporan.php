<?php

namespace App\Http\Controllers\be\laporan;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ConLaporan extends Controller
{
    public function index(Request $request)
    {
        // $listMenu = DB::table('menu')->get();
        // foreach ($listMenu as $list) {
        //     $transList = DB::table('transaksi_list')
        //         ->select(
        //             DB::raw('SUM(total_harga) as total_harga'),
        //             DB::raw('SUM(qty) as jml_qty')
        //         )
        //         ->where('menu_id', $list->id)
        //         ->first();

        //     $jmlQty     = $transList->jml_qty == null ? 0 : $transList->jml_qty;
        //     $totalHarga = $transList->total_harga == null ? 0 : $transList->total_harga;

        //     $arrList[] = array(
        //         'nm_menu'     => $list->nm_menu,
        //         'stok'        => $list->stok,
        //         'qty'         => $jmlQty,
        //         'harga'       => $list->harga,
        //         'total_harga' => $totalHarga,
        //     );
        // }
        // dd($arrList);

        // Default awal dan akhir bulan
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        // Cek apakah user memasukkan tanggal pencarian
        if ($request->startDate && $request->endDate) {
            $startDate = $request->startDate; // Tanggal awal dari input user
            $endDate = $request->endDate;     // Tanggal akhir dari input user
        }

        $pendapatanBlnSkrng = DB::table('transaksi')
            ->whereBetween('tgl_trans', [$startDate, $endDate])
            ->sum('total_trans');

        $totalTransBlnSkrng = DB::table('transaksi')
            ->whereBetween('tgl_trans', [$startDate, $endDate])
            ->count();

        // Query data penjualan
        $rekapPenjualan = DB::table('transaksi_list')
            ->join('transaksi', 'transaksi.kd_trans', '=', 'transaksi_list.kd_trans')
            ->join('menu', 'menu.id', '=', 'transaksi_list.menu_id')
            ->select(
                DB::raw('DATE(transaksi.tgl_trans) as tanggal'),
                'menu.nm_menu',
                DB::raw('SUM(transaksi_list.qty) as jumlah'),
                'menu.harga',
                DB::raw('SUM(transaksi_list.total_harga) as total_penjualan')
            )
            ->whereBetween('transaksi.tgl_trans', [$startDate, $endDate]) // Filter bulan sekarang
            ->groupBy('tanggal', 'menu.nm_menu', 'menu.harga')
            ->orderBy('tanggal', 'asc')
            ->get();

        // dd($rekapPenjualan);
        if ($rekapPenjualan->isEmpty()) {
            $rekapPenjualan = [];
        }
        
        return view('be.pages.laporan.index', compact(
            'rekapPenjualan',
            'totalTransBlnSkrng',
            'pendapatanBlnSkrng'
        ));
    }

    public function cetakLaporan(Request $request)
    {
         // Tanggal default untuk bulan ini
        $startDate = $request->startDate ? Carbon::parse($request->startDate)->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = $request->endDate ? Carbon::parse($request->endDate)->endOfDay() : Carbon::now()->endOfMonth();

        // Perhitungan pendapatan dan total transaksi
        $pendapatanBlnSkrng = DB::table('transaksi')
            ->whereBetween('tgl_trans', [$startDate, $endDate])
            ->sum('total_trans');

        // Ambil data sesuai pencarian
        $rekapPenjualan = DB::table('transaksi_list')
            ->join('transaksi', 'transaksi.kd_trans', '=', 'transaksi_list.kd_trans')
            ->join('menu', 'menu.id', '=', 'transaksi_list.menu_id')
            ->select(
                DB::raw('DATE(transaksi.tgl_trans) as tanggal'),
                'menu.nm_menu',
                DB::raw('SUM(transaksi_list.qty) as jumlah'),
                'menu.harga',
                DB::raw('SUM(transaksi_list.total_harga) as total_penjualan')
            )
            ->whereBetween('transaksi.tgl_trans', [$startDate, $endDate])
            ->groupBy('tanggal', 'menu.nm_menu', 'menu.harga')
            ->orderBy('tanggal', 'asc')
            ->get();
        // Render view ke HTML
        return view('be.pages.laporan.cetak-laporan', compact(
            'rekapPenjualan',
            'pendapatanBlnSkrng',
            'startDate',
            'endDate'
        ));
    }
}
