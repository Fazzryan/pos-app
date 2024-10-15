<?php

namespace App\Http\Controllers\be\laporan;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConLaporan extends Controller
{
    public function index()
    {
        $listMenu = DB::table('menu')->get();
        foreach ($listMenu as $list) {
            $transList = DB::table('transaksi_list')
                ->select(
                    DB::raw('SUM(total_harga) as total_harga'),
                    DB::raw('SUM(qty) as jml_qty')
                )
                ->where('menu_id', $list->id)
                ->first();

            $jmlQty     = $transList->jml_qty == null ? 0 : $transList->jml_qty;
            $totalHarga = $transList->total_harga == null ? 0 : $transList->total_harga;

            $arrList[] = array(
                'nm_menu'     => $list->nm_menu,
                'stok'        => $list->stok,
                'qty'         => $jmlQty,
                'harga'       => $list->harga,
                'total_harga' => $totalHarga,
            );
        }
        // dd($arrList);
        return view('be.pages.laporan.index', compact('arrList'));
    }
}
