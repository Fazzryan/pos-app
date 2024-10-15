<?php

namespace App\Http\Controllers\be\riwayat;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConRiwayat extends Controller
{
    public function index()
    {
        $getTransaksi = DB::table('transaksi')
            // ->join('transaksi_list', 'transaksi_list.kd_trans', '=', 'transaksi.kd_trans')
            ->join('user', 'user.id', '=', 'transaksi.user_id')
            ->select('transaksi.*', 'user.nm_lengkap')
            ->orderBy('transaksi.tgl_trans', 'desc')
            ->get();
        return view('be.pages.riwayat.index', compact('getTransaksi'));
    }

    public function get_list_menu(Request $request)
    {
        $kdTrans = $request->kd_trans;
        if ($kdTrans == null || $kdTrans == "") {
            return response()->json([
                'status'  => "204",
                'message' => 'Kode Transaksi Tidak Ditemukan!',
            ]);
        } else {
            // cek kode apakah ada di database
            $cekKode = DB::table('transaksi_list')->where('kd_trans', $kdTrans)->count();
            if ($cekKode > 0) {
                $getTransaksiList = DB::table('transaksi_list')
                    ->join('menu', 'menu.id', '=', 'transaksi_list.menu_id')
                    ->select('transaksi_list.*', 'menu.nm_menu')
                    ->where('kd_trans', $kdTrans)
                    ->get();
                return response()->json([
                    'status'  => "200",
                    'message' => 'Data ditemukan!',
                    'data'    => $getTransaksiList
                ]);
            } else {
                return response()->json([
                    'status'  => "204",
                    'message' => 'Kode Transaksi Tidak Ditemukan!',
                ]);
            }
        }
    }
    //--------------------------------------------------------------------------
    //  Act Add
    //--------------------------------------------------------------------------


    //--------------------------------------------------------------------------
    //  Act edit
    //--------------------------------------------------------------------------
    public function act_edit(Request $request)
    {
    }

    //--------------------------------------------------------------------------
    //  Act delete
    //--------------------------------------------------------------------------
    public function act_delete(Request $request)
    {
        $kdTrans = $request->kd_trans;
        if ($kdTrans == null) {
            return redirect()->back()->with('failed', 'Kode Transaksi Tidak Boleh Kosong!');
        } else {
            // cek kode apakah ada di database
            $cekKode = DB::table('transaksi')->where('kd_trans', $kdTrans)->count();
            if ($cekKode > 0) {
                $getTrans = DB::table('transaksi')->where('kd_trans', $kdTrans)->delete();
                $getTransList = DB::table('transaksi_list')->where('kd_trans', $kdTrans)->delete();

                return redirect()->back()->with('success', 'Data Transaksi Berhasil Dihapus!');
            } else {
                return redirect()->back()->with('failed', 'Kode Transaksi Tidak Ditemukan!');
            }
        }
    }
}
