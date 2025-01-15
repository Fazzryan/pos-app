<?php

namespace App\Http\Controllers\be\menu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConMenu extends Controller
{
    public function index()
    {
        $menu = DB::table('menu')
            ->join('kategori', 'menu.kategori_id', '=', 'kategori.id')
            ->select('menu.*', 'kategori.nm_kategori')
            ->orderBy('menu.id', 'desc')
            ->get();
        $kategori = DB::table('kategori')->get();
        return view('be.pages.menu.index', compact('menu', 'kategori'));
    }

    //--------------------------------------------------------------------------
    //  Act Add
    //--------------------------------------------------------------------------
    public function act_add(Request $request)
    {
        $nmMenu      = ucwords(strtolower($request->nm_menu));
        $kategoriId  = $request->kategori_id;
        $harga       = $request->harga;
        $harga_modal = $request->harga_modal;
        $stok        = $request->stok;
        $foto        = $request->foto;

        $dataAdd = array(
            'nm_menu'     => $nmMenu,
            'kategori_id' => $kategoriId,
            'harga'       => $harga,
            'harga_modal' => $harga_modal,
            'stok'        => $stok,
        );

        $validasi = $this->validate($request, [
            'nm_menu'     => 'required|min:3|max:100',
            'kategori_id' => 'required',
            'harga'       => 'required|numeric',
            'harga_modal' => 'required|numeric',
            'stok'        => 'required|numeric',
            'foto'        => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($validasi) {
            // cek apakah nama menu sudah ada
            $cekMenu = DB::table('menu')->where('nm_menu', $nmMenu)->count();
            if ($cekMenu > 0) {
                return redirect()->back()->with('failed', 'Menu sudah ada!');
            } else {
                $oriExtention = $foto->getClientOriginalExtension();
                $namaFoto     = "menu-" . rand() . "." . $oriExtention;
                $foto->move(public_path('assets/be/images/menu/'), $namaFoto);
                $dataAddWithImg = array_merge($dataAdd, array('foto' => $namaFoto));

                DB::table('menu')->insert($dataAddWithImg);
                return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan!');
            }
        }
    }
    //--------------------------------------------------------------------------
    //  Act Edit
    //--------------------------------------------------------------------------
    public function act_edit(Request $request)
    {
        $menuId     = $request->menu_id;
        $nmMenu     = ucwords(strtolower($request->nm_menu));
        $kategoriId = $request->kategori_id;
        $harga      = $request->harga;
        $harga_modal = $request->harga_modal;
        $stok       = $request->stok;
        $foto       = $request->foto;

        $dataUpd = array(
            'nm_menu'     => $nmMenu,
            'kategori_id' => $kategoriId,
            'harga'       => $harga,
            'harga_modal' => $harga_modal,
            'stok'        => $stok,
        );

        $validasi = $this->validate($request, [
            'nm_menu'     => 'required|min:3|max:100',
            'kategori_id' => 'required',
            'harga'       => 'required|numeric|min:1000|max:100000000',
            'stok'        => 'required|numeric|min:1|max:999',
        ]);
        // 'foto'        => 'required|image|mimes:jpg,png,jpeg|max:2048'

        if ($foto == null) {
            if ($validasi) {
                // cek apakah id ada
                $cekId = DB::table('menu')->where('id', $menuId)->count();
                if ($cekId > 0) {
                    // cek perubahan data
                    $cekPerubahan = DB::table('menu')
                        ->where('id', $menuId)
                        ->where('kategori_id', $kategoriId)
                        ->where('nm_menu', $nmMenu)
                        ->where('harga', $harga)
                        ->where('harga_modal', $harga_modal)
                        ->where('stok', $stok)->count();
                    if ($cekPerubahan > 0) {
                        return redirect()->back()->with('failed', 'Tidak ada perubahan!');
                    } else {
                        // cek apakah data tersedia
                        $cekIdNm = DB::table('menu')->where('id', $menuId)->where('nm_menu', $nmMenu)->count();
                        if ($cekIdNm > 0) {
                            $queryUpd = DB::table('menu')->where('id', $menuId)->update($dataUpd);
                            return redirect()->back()->with('success', 'Menu berhasil diubah!');
                        } else {
                            // cek apakah nama menu sudah ada
                            $cekNama = DB::table('menu')->where('nm_menu', $nmMenu)->count();
                            if ($cekNama > 0) {
                                return redirect()->back()->with('failed', 'Nama menu sudah ada!');
                            } else {
                                $queryUpd = DB::table('menu')->where('id', $menuId)->update($dataUpd);
                                return redirect()->back()->with('success', 'Menu berhasil diubah!');
                            }
                        }
                    }
                } else {
                    return redirect()->back()->with('failed', 'Menu tidak ditemukan!');
                }
            }
        } else {
            $img = $request->file('foto');
            if ($validasi) {
                // cek id
                $checkId = DB::table('menu')->where('id', $menuId)->count();
                if ($checkId > 0) {
                    // validasi foto
                    $oriExtention = $img->getClientOriginalExtension();
                    $oriSize      = number_format($img->getSize() / 1024, 0); //KB
                    $imageSize    = str_replace(',', '', $oriSize);

                    if (($oriExtention == "jpg") || ($oriExtention == "jpeg") || ($oriExtention == "png") || ($oriExtention == "PNG")) {
                        if ($imageSize > 2000) {
                            return redirect()->back()->with('failed', 'Foto tidak boleh lebih dari 2 Mb!')->withInput();
                        } else {
                            //package update
                            $namaFoto     = "menu-" . rand() . "." . $oriExtention;
                            $dataUpdtWithImg = array_merge($dataUpd, array('foto' => $namaFoto));

                            // cek apakah data tersedia 
                            $checkAvailable = DB::table('menu')->where('id', $menuId)->where('nm_menu', $nmMenu)->count();
                            if ($checkAvailable > 0) {
                                //Unlink Foto
                                $getFoto = DB::table('menu')->where('id', $menuId)->first()->foto;
                                unlink(public_path('/assets/be/images/menu/' . $getFoto));
                                $img->move(public_path('/assets/be/images/menu/'), $namaFoto);

                                $queryUpdate = DB::table('menu')->where('id', $menuId)->update($dataUpdtWithImg);
                                return redirect()->back()->with('success', 'Menu berhasil diubah!');
                            } else {
                                // cek nama apakah tersedia
                                $checkName = DB::table('menu')->where('nm_menu', $nmMenu)->count();
                                if ($checkName > 0) {
                                    return redirect()->back()->with('failed', 'Nama menu sudah ada!')->withInput();
                                } else {
                                    //Unlink Foto
                                    $getFoto = DB::table('menu')->where('id', $menuId)->first()->foto;
                                    if ($getFoto > 0) {
                                        unlink(public_path('/assets/be/images/menu/' . $getFoto));
                                    }
                                    $img->move(public_path('/assets/be/images/menu/'), $namaFoto);
                                    $queryUpdate = DB::table('menu')->where('id', $menuId)->update($dataUpdtWithImg);
                                    return redirect()->back()->with('success', 'Menu berhasil diubah!');
                                }
                            }
                        }
                    }
                } else {
                    return redirect()->back()->with('failed', 'Menu tidak ditemukan!');
                }
            }
        }
    }
    //--------------------------------------------------------------------------
    //  Act Delete
    //--------------------------------------------------------------------------
    public function act_delete(Request $request)
    {
        $menuId = $request->menu_id;

        if ($menuId == null) {
            return redirect()->back()->with('failed', 'Menu tidak boleh kosong!');
        }

        // cek apakah id tersedia
        $cekId = DB::table('menu')->where('id', $menuId)->count();
        if ($cekId > 0) {
            // cek relasi ke riwayat transaksi
            $cekRelasi = DB::table('transaksi_list')->where('menu_id', $menuId)->count();
            if ($cekRelasi > 0) {
                return redirect()->back()->with('failed', 'Menu tidak dapat dihapus karena digunakan oleh salah satu Transaksi!');
            } else {
                $getFoto = DB::table('menu')->where('id', $menuId)->first()->foto;
                unlink(public_path('/assets/be/images/menu/' . $getFoto));
                // hapus data
                $delete = DB::table('menu')->where('id', $menuId)->delete();
                return redirect()->back()->with('success', 'Menu berhasil dihapus!');
            }
        } else {
            return redirect()->back()->with('failed', 'Menu tidak ditemukan!');
        }
    }
}
