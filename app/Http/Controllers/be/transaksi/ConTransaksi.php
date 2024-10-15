<?php

namespace App\Http\Controllers\be\transaksi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConTransaksi extends Controller
{
    public function index()
    {
        $menu = DB::table('menu')
            ->join('kategori', 'kategori.id', '=', 'menu.kategori_id')
            ->select('menu.*')
            ->where('stok', '>', 1)
            ->orderBy('kategori.nm_kategori')
            ->get();
        return view('be.pages.transaksi.index', compact('menu'));
    }

    //----------------------------------------- ---------------------------------
    //  Act Add
    //--------------------------------------------------------------------------
    public function act_add(Request $request)
    {
        // Lakukan validasi sebelum memulai transaksi
        $validasi = $this->validate($request, [
            'list_menu'    => 'required',
            'user_id'      => 'required',
            'nm_pelanggan' => 'required',
            'tgl_trans'    => 'required',
            'jam'          => 'required',
            'total_trans'  => 'required',
            'total_bayar'  => 'required',
            'kembalian'    => 'required',
        ]);

        // Jalankan transaksi
        try {
            DB::beginTransaction();

            $kdTrans     = "TRS-" . date('Ymd') . rand(10, 1000);
            $arrTransaksiList = json_decode($request->list_menu, TRUE);
            $userId      = $request->user_id;
            $nmPelanggan = ucwords(strtolower($request->nm_pelanggan));
            $tglTrans    = $request->tgl_trans;
            $jam         = $request->jam;
            $totalTrans  = (int)str_replace('.', '', $request->total_trans);
            $totalBayar  = (int)str_replace('.', '', $request->total_bayar);
            $kembalian   = (int)str_replace('.', '', $request->kembalian);

            // Lakukan pengecekan stok
            foreach ($arrTransaksiList as $list) {
                $id    = $list['id'];
                $qty   = $list['qty'];

                // Ambil stok produk
                $stokMenu = DB::table('menu')->where('id', $id)->first()->stok;

                // Jika qty melebihi stok yang tersedia, batalkan transaksi
                if ($qty > $stokMenu) {
                    // Rollback transaksi
                    DB::rollBack();

                    return response()->json([
                        'status' => 400,
                        'message' => 'Stok tidak cukup untuk menu ' . $list['nama_menu'] . ', stok tersedia: ' . $stokMenu
                    ], 400);
                }
            }

            // Proses insert transaksi
            $arrAddTrans = [
                'kd_trans'     => $kdTrans,
                'nm_pelanggan' => $nmPelanggan,
                'user_id'      => $userId,
                'tgl_trans'    => $tglTrans,
                'jam'          => $jam,
                'total_trans'  => $totalTrans,
                'total_bayar'  => $totalBayar,
                'kembalian'    => $kembalian,
            ];
            $queryAddTrans = DB::table('transaksi')->insert($arrAddTrans);

            if ($queryAddTrans) {
                $arrAddTransaksiList = [];
                foreach ($arrTransaksiList as $list) {
                    $id    = $list['id'];
                    $harga = $list['harga'];
                    $qty   = $list['qty'];

                    $arrAddTransaksiList[] = [
                        'kd_trans'    => $kdTrans,
                        'menu_id'     => $id,
                        'harga'       => $harga / $qty,
                        'qty'         => $qty,
                        'total_harga' => $harga
                    ];
                }

                // Insert transaksi list dan update stok
                DB::table('transaksi_list')->insert($arrAddTransaksiList);
                foreach ($arrAddTransaksiList as $listTrans) {
                    $stokLama = DB::table('menu')->where('id', $listTrans['menu_id'])->first()->stok;
                    $stokSkrng = $stokLama - $listTrans['qty'];
                    DB::table('menu')->where('id', $listTrans['menu_id'])->update(['stok' => $stokSkrng]);
                }

                // Commit transaksi
                DB::commit();

                // Kembalikan response sukses
                return response()->json([
                    'status' => 200,
                    'message' => 'Transaksi berhasil disimpan!',
                    'data'    => [
                        'kd_trans'     => $kdTrans,
                        'nm_pelanggan' => $nmPelanggan,
                        'tgl_trans'    => $tglTrans,
                        'jam'          => $jam,
                        'total_trans'  => $totalTrans,
                        'total_bayar'  => $totalBayar,
                        'kembalian'    => $kembalian,
                    ]
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan pada sistem: ' . $e->getMessage(),
            ], 500);
        }
    }


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
    }
}
