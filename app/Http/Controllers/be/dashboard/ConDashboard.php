<?php

namespace App\Http\Controllers\be\dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConDashboard extends Controller
{
    public function index()
    {
        $totalMenu = DB::table('menu')->count();
        $totalPetugas = DB::table('user')->join('user_autentikasi', 'user.id', '=', 'user_autentikasi.user_id')->count();
        $totalTransaksi = DB::table('transaksi')->count();

        $date = date("Y-m-d");
        $bulan = explode('-', $date)[1];
        // dd($bulan);
        $pendapatan = DB::table('transaksi')->whereMonth('tgl_trans', $bulan)->sum('total_trans');

        return view('be.pages.dashboard.index', compact('totalMenu', 'totalPetugas', 'totalTransaksi', 'pendapatan'));
    }
}
