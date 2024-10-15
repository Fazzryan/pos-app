<?php

namespace App\Http\Controllers\be\kategori;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class ConKategori extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')->get();
        return view('be.pages.kategori.index', compact('kategori'));
    }

    //--------------------------------------------------------------------------
    //  Act Add
    //--------------------------------------------------------------------------
    public function act_add(Request $request)
    {
        $nmKategori = ucwords(strtolower($request->nm_kategori));

        $validasi = $this->validate($request, [
            'nm_kategori' => 'required|min:3|max:30'
        ]);

        $dataAdd = array(
            'nm_kategori' => $nmKategori
        );

        if ($validasi) {
            // cek apakah kategori tersedia
            $cekKategori = DB::table('kategori')->where('nm_kategori', $nmKategori)->count();
            if ($cekKategori > 0) {
                return redirect()->back()->with('failed', 'Nama kategori sudah ada!');
            } else {
                $queryAdd = DB::table('kategori')->insert($dataAdd);
                return redirect()->back()->with('success', 'Nama kategori berhasil ditambahkan!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Act Edit
    //--------------------------------------------------------------------------
    public function act_edit(Request $request)
    {
        $kategoriId = $request->kategori_id;
        $nmKategori = ucwords(strtolower($request->nm_kategori));

        $validasi = $this->validate($request, [
            'nm_kategori' => 'required|min:3|max:30'
        ]);

        $dataUpdate = array(
            'nm_kategori' => $nmKategori
        );

        if ($validasi) {
            // cek apakah id kategori ada
            $cekId = DB::table('kategori')->where('id', $kategoriId)->count();
            if ($cekId > 0) {
                // cek perubahan data
                $cekPerubahan = DB::table('kategori')->where('id', $kategoriId)->where('nm_kategori', $nmKategori)->count();
                if ($cekPerubahan > 0) {
                    return redirect()->back()->with('failed', 'Tidak ada perubahan!');
                } else {
                    // cek apakah kategori tersedia
                    $cekKategori = DB::table('kategori')->where('nm_kategori', $nmKategori)->count();
                    if ($cekKategori > 0) {
                        return redirect()->back()->with('failed', 'Nama kategori sudah ada!');
                    } else {
                        $queryUpdate = DB::table('kategori')->where('id', $kategoriId)->update($dataUpdate);
                        return redirect()->back()->with('success', 'Nama kategori berhasil diubah!');
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Kategori tidak ditemukan!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Act Delete
    //--------------------------------------------------------------------------
    public function act_delete(Request $request)
    {
        $kategoriId = $request->kategori_id;
        if ($kategoriId == null) {
            return redirect()->back()->with('failed', 'Id kategori tidak boleh kosong!');
        } else {
            // cek apakah id terdaftar di databse
            $cekId = DB::table('kategori')->where('id', $kategoriId)->count();
            if ($cekId > 0) {
                // cek rekasi ke menu
                $cekRelasi = DB::table('menu')->where('kategori_id', $kategoriId)->count();
                if ($cekRelasi > 0) {
                    return redirect()->back()->with('failed', 'Kategori digunakan oleh salah satu menu!');
                } else {
                    $queryDel = DB::table('kategori')->where('id', $kategoriId)->delete();
                    return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
                }
            } else {
                return redirect()->back()->with('failed', 'Kategori tidak ditemukan!');
            }
        }
    }
}
