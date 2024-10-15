<?php

namespace App\Http\Controllers\be\riwayat;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConCetakNota extends Controller
{
    public function cetak_nota(Request $request)
    {
        $kodeTrans = $request->kd_trans;
        if ($kodeTrans == null) {
            return redirect()->back()->with('failed', 'Kode Transaksi Tidak Boleh Kosong!');
        } else {
            $cekKode = DB::table('transaksi')->where('kd_trans', $kodeTrans)->count();
            if ($cekKode > 0) {
                $transaksi = DB::table('transaksi')
                    ->join('user', 'user.id', '=', 'transaksi.user_id')
                    ->select(
                        'transaksi.*',
                        'user.nm_lengkap',
                    )
                    ->where('transaksi.kd_trans', $kodeTrans)->first();
                $transaksiList = DB::table('transaksi_list')
                    ->join('menu', 'menu.id', '=', 'transaksi_list.menu_id')
                    ->select(
                        'transaksi_list.*',
                        'menu.nm_menu',
                    )
                    ->where('transaksi_list.kd_trans', $kodeTrans)->get();
                return view('be.pages.riwayat.cetak_nota', compact('transaksi', 'transaksiList'));
            } else {
                return redirect()->back()->with('failed', 'Kode Transaksi Tidak Ditemukan!');
            }
        }
    }
}
