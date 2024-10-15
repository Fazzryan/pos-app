<?php

namespace App\Http\Controllers\be\petugas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConPetugas extends Controller
{
    public function index()
    {
        $petugas = DB::table('user')
            ->join('user_autentikasi', 'user.id', '=', 'user_autentikasi.user_id')
            ->select(
                'user.*',
                'user_autentikasi.user_id',
                'user_autentikasi.username',
                'user_autentikasi.pass',
                'user_autentikasi.role'
            )->get();
        return view('be.pages.petugas.index', compact('petugas'));
    }

    public function act_show($id)
    {
        $userId = base64_decode($id);
        $user = DB::table('user')->where('id', $userId)->first();

        return view('be.pages.petugas.edit', compact('user'));
    }

    //--------------------------------------------------------------------------
    //  Act Add
    //--------------------------------------------------------------------------
    public function act_add(Request $request)
    {
        $nmLengkap = ucwords(strtolower($request->nm_lengkap));
        $alamat    = $request->alamat;
        $nohp      = $request->nohp;
        $jk        = $request->jk;

        // untuk autentikasi
        $username = $request->username;
        $password = bcrypt($request->password);
        $pass     = $request->password;
        $role     = $request->role;

        $dataAddAuth = array(
            'username' => $username,
            'password' => $password,
            'pass'     => $pass,
            'role'     => $role,
        );

        $dataAddUser = array(
            'nm_lengkap' => $nmLengkap,
            'alamat'     => $alamat,
            'nohp'       => $nohp,
            'jk'         => $jk,
        );

        $validasi = $this->validate($request, [
            'username'   => 'required|min:3|max:50',
            'password'   => 'required|min:5|max:150',
            'role'       => 'required',
            'nm_lengkap' => 'required|min:3|max:50',
            'alamat'     => 'required|min:3|max:255',
            'nohp'       => 'required|min:12|max:15',
            'jk'         => 'required',
        ]);

        if ($validasi) {
            // cek nomor telepon apakah tersedia
            $cekNohp = DB::table('user')->where('nohp', $nohp)->count();
            if ($cekNohp > 0) {
                return redirect()->back()->with('failed', 'Nomor telepon tidak tersedia!')->withInput();
            } else {
                // cek apakah username tersedia
                $cekUsr = DB::table('user_autentikasi')->where('username', $username)->count();
                if ($cekUsr > 0) {
                    return redirect()->back()->with('failed', 'Username tidak tersedia!')->withInput();
                } else {
                    $getIdUsr = DB::table('user')->insertGetId($dataAddUser);
                    $dataAuthMerge = array_merge($dataAddAuth, array('user_id' => $getIdUsr));
                    DB::table('user_autentikasi')->insert($dataAuthMerge);
                    return redirect()->back()->with('success', 'Data petugas berhasil ditambahkan!');
                }
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Act edit
    //--------------------------------------------------------------------------
    public function act_edit_auth(Request $request)
    {
        $userId = $request->user_id;
        $username = $request->username;
        $password = bcrypt($request->password);
        $pass     = $request->password;
        $role     = $request->role;

        $dataUpd = array(
            'username' => $username,
            'password' => $password,
            'pass'     => $pass,
            'role'     => $role,
        );

        $validasi = $this->validate($request, [
            'username' => 'required|min:3|max:50',
            'password' => 'required|min:5|max:150',
            'role'     => 'required',
        ]);

        if ($validasi) {
            // cek id
            $cekId = DB::table('user_autentikasi')->where('user_id', $userId)->count();
            if ($cekId > 0) {
                // cek perubahan
                $cekPerubahan = DB::table('user_autentikasi')
                    ->where('username', $username)
                    ->where('pass', $pass)
                    ->where('role', $role)->count();
                if ($cekPerubahan > 0) {
                    return redirect()->back()->with('failed', 'Tidak ada perubahan!');
                } else {
                    // cek id dan username
                    $cekIdUsr = DB::table('user_autentikasi')->where('id', $userId)->where('username', $username)->count();
                    if ($cekIdUsr > 0) {
                        // update
                        $update = DB::table('user_autentikasi')->where('id', $userId)->update($dataUpd);
                        return redirect()->back()->with('success', 'Data autentikasi berhasil diubah!');
                    } else {
                        // cek username apakah tersedia
                        $cekUsr = DB::table('user_autentikasi')->where('username', $username)->count();
                        if ($cekUsr > 0) {
                            return redirect()->back()->with('failed', 'Username tidak tersedia!');
                        } else {
                            $update = DB::table('user_autentikasi')->where('id', $userId)->update($dataUpd);
                            return redirect()->back()->with('success', 'Data autentikasi berhasil diubah!');
                        }
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'User tidak ditemukan!');
            }
        }
    }

    public function act_edit(Request $request)
    {
        $userId = $request->user_id;
        $nmLengkap = ucwords(strtolower($request->nm_lengkap));
        $alamat    = $request->alamat;
        $nohp      = $request->nohp;
        $jk        = $request->jk;

        $dataUpd = array(
            'nm_lengkap' => $nmLengkap,
            'alamat'     => $alamat,
            'nohp'       => $nohp,
            'jk'         => $jk,
        );

        $validasi = $this->validate($request, [
            'nm_lengkap' => 'required|min:3|max:50',
            'alamat'     => 'required|min:3|max:255',
            'nohp'       => 'required|min:12|max:15',
            'jk'         => 'required',
        ]);

        if ($validasi) {
            // cek id 
            $cekId = DB::table('user')->where('id', $userId)->count();
            if ($cekId > 0) {
                // cek perubahan
                $cekPerubahan = DB::table('user')
                    ->where('nm_lengkap', $nmLengkap)
                    ->where('alamat', $alamat)
                    ->where('nohp', $nohp)
                    ->where('jk', $jk)->count();
                if ($cekPerubahan > 0) {
                    return redirect()->back()->with('failed', 'Tidak ada perubahan!');
                } else {
                    // cek id dan telepon
                    $cekIdTelp = DB::table('user')->where('id', $userId)->where('nohp', $nohp)->count();
                    if ($cekIdTelp > 0) {
                        // update
                        $update = DB::table('user')->where('id', $userId)->update($dataUpd);
                        return redirect()->back()->with('success', 'Data petugas berhasil diubah!');
                    } else {
                        // cek telepon apakah tersedia
                        $cekUsr = DB::table('user')->where('nohp', $nohp)->count();
                        if ($cekUsr > 0) {
                            return redirect()->back()->with('failed', 'Nomor Telepon sudah ada!');
                        } else {
                            $update = DB::table('user')->where('id', $userId)->update($dataUpd);
                            return redirect()->back()->with('success', 'Data petugas berhasil diubah!');
                        }
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Petugas tidak ditemukan!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Act delete
    //--------------------------------------------------------------------------
    public function act_delete(Request $request)
    {
        $petugasId = $request->petugas_id;
        if ($petugasId == null) {
            return redirect()->back()->with('failed', 'Id petugas tidak boleh kosong!');
        } else {
            // cek apakah id tersedia pada tabel user dan user auth
            $cekId = DB::table('user')->where('id', $petugasId)->count();
            $cekIdAuth = DB::table('user_autentikasi')->where('user_id', $petugasId)->count();
            if ($cekId > 0 && $cekIdAuth > 0) {
                // hapus data dari tbl user dan user auth
                DB::table('user')->where('id', $petugasId)->delete();
                DB::table('user_autentikasi')->where('user_id', $petugasId)->delete();
                return redirect()->back()->with('success', 'Data Petugas berhasil dihapus!');
            } else {
                return redirect()->back()->with('failed', 'Data Petugas tidak ditemukan!');
            }
        }
    }
}
