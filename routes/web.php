<?php

use App\Http\Controllers\be\auth\ConAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\dashboard\ConDashboard;
use App\Http\Controllers\be\kategori\ConKategori;
use App\Http\Controllers\be\laporan\ConLaporan;
use App\Http\Controllers\be\menu\ConMenu;
use App\Http\Controllers\be\petugas\ConPetugas;
use App\Http\Controllers\be\riwayat\ConCetakNota;
use App\Http\Controllers\be\riwayat\ConRiwayat;
use App\Http\Controllers\be\transaksi\ConTransaksi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['as' => 'auth.', 'prefix' => '/'], function () {
    Route::get('/login', [ConAuth::class, 'login'])->name('login');
    Route::get('/registrasi', [ConAuth::class, 'registrasi'])->name('registrasi');

    Route::post('/act_login', [ConAuth::class, 'act_login'])->name('act_login');
    Route::post('/act_registrasi', [ConAuth::class, 'act_registrasi'])->name('act_registrasi');
    Route::get('/act_logout', [ConAuth::class, 'act_logout'])->name('act_logout');
});

Route::group(['as' => 'fe.', 'prefix' => '/'], function () {
    //--------------------------------------------------------------------------
    //  Routes Beranda
    //--------------------------------------------------------------------------
});

Route::group(['as' => 'be.', 'prefix' => '/dashboard', 'middleware' => ['CheckLogin', 'CheckRole']], function () {
    //--------------------------------------------------------------------------
    //  Routes Dashboard
    //--------------------------------------------------------------------------
    Route::get('/', [ConDashboard::class, 'index'])->name('dashboard');

    //--------------------------------------------------------------------------
    //  Routes Transaksi
    //--------------------------------------------------------------------------
    Route::group(['as' => 'transaksi.', 'prefix' => '/transaksi'], function () {
        Route::get('/', [ConTransaksi::class, 'index'])->name('list');

        Route::post('/act_add', [ConTransaksi::class, 'act_add'])->name('act_add');

        Route::post('/act_edit', [ConTransaksi::class, 'act_edit'])->name('act_edit');
        Route::post('/act_delete', [ConTransaksi::class, 'act_delete'])->name('act_delete');
    });

    //--------------------------------------------------------------------------
    //  Routes Riwayat
    //--------------------------------------------------------------------------
    Route::group(['as' => 'riwayat.', 'prefix' => '/riwayat'], function () {
        Route::get('/', [ConRiwayat::class, 'index'])->name('list');
        Route::get('/get_list_menu/{kd_trans?}', [ConRiwayat::class, 'get_list_menu'])->name('get_list_menu');
        Route::get('/cetak-nota/{kd_trans?}', [ConCetakNota::class, 'cetak_nota'])->name('cetak_nota');

        Route::post('/act_delete', [ConRiwayat::class, 'act_delete'])->name('act_delete');
    });

    //--------------------------------------------------------------------------
    //  Routes Menu
    //--------------------------------------------------------------------------
    Route::group(['as' => 'menu.', 'prefix' => '/menu'], function () {
        Route::get('/', [ConMenu::class, 'index'])->name('list');

        Route::post('/act_add', [ConMenu::class, 'act_add'])->name('act_add');
        Route::post('/act_edit', [ConMenu::class, 'act_edit'])->name('act_edit');
        Route::post('/act_delete', [ConMenu::class, 'act_delete'])->name('act_delete');
    });

    //--------------------------------------------------------------------------
    //  Routes Kategori
    //--------------------------------------------------------------------------
    Route::group(['as' => 'kategori.', 'prefix' => '/kategori'], function () {
        Route::get('/', [ConKategori::class, 'index'])->name('list');

        Route::post('/act_add', [ConKategori::class, 'act_add'])->name('act_add');
        Route::post('/act_edit', [ConKategori::class, 'act_edit'])->name('act_edit');
        Route::post('/act_delete', [ConKategori::class, 'act_delete'])->name('act_delete');
    });

    //--------------------------------------------------------------------------
    //  Routes Petugas
    //--------------------------------------------------------------------------
    Route::group(['as' => 'petugas.', 'prefix' => '/petugas'], function () {
        Route::get('/', [ConPetugas::class, 'index'])->name('list');
        Route::get('/profile/{id?}', [ConPetugas::class, 'act_show'])->name('act_show');

        Route::post('/act_edit_auth', [ConPetugas::class, 'act_edit_auth'])->name('act_edit_auth');

        Route::post('/act_add', [ConPetugas::class, 'act_add'])->name('act_add');
        Route::post('/act_edit', [ConPetugas::class, 'act_edit'])->name('act_edit');
        Route::post('/act_delete', [ConPetugas::class, 'act_delete'])->name('act_delete');
    });

    //--------------------------------------------------------------------------
    //  Routes Laporan
    //--------------------------------------------------------------------------
    Route::group(['as' => 'laporan.', 'prefix' => '/laporan'], function () {
        Route::get('/', [ConLaporan::class, 'index'])->name('list');
        Route::get('/cetak-laporan', [ConLaporan::class, 'cetakLaporan'])->name('cetakLaporan');
    });
});
