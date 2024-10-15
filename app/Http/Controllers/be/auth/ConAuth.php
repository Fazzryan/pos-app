<?php

namespace App\Http\Controllers\be\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConAuth extends Controller
{
    public function login()
    {
        $checkLogin = $this->checkLogin();
        if ($checkLogin == 'true') {
            return redirect()->route('be.dashboard')->with('success', 'kamu sudah login!');
        } else {
            return view('be.pages.auth.login');
        }
    }
    public function registrasi()
    {
        $checkLogin = $this->checkLogin();
        if ($checkLogin == 'true') {
            return redirect()->route('be.dashboard')->with('success', 'kamu sudah login!');
        } else {
            return view('be.pages.auth.registrasi');
        }
    }

    public function checkLogin()
    {
        $loginSession = Session::get('login');
        if ($loginSession == TRUE) {
            $login = 'true';
        } else {
            $login = 'false';
        }
        return $login;
    }

    public function act_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $validasi = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validasi) {
            if (($username == 'superadmin') && ($password == 'dinda123')) {
                $user_session = array(
                    'user_id'  => 0,
                    'username' => 'superadmin',
                    'role'     => 'admin',
                );

                Session::put('user_session', $user_session);
                Session::put('login', true);

                return redirect()->route('be.dashboard')->with('success', 'Login berhasil!');
            } else {
                $user = DB::table('user_autentikasi')->where('username', $username)->first();
                // validasi user
                if (!$user) {
                    return redirect()->back()->with('failed', 'Username tidak ditemukan!')->withInput();
                }

                if (password_verify($password, $user->password)) {

                    $user_session = array(
                        'user_id'  => $user->user_id,
                        'username' => $user->username,
                        'role'     => $user->role,
                    );

                    Session::put('user_session', $user_session);
                    Session::put('login', true);

                    if ($user->role == 'admin' || $user->role == 'kasir') {
                        return redirect()->route('be.dashboard')->with('success', 'Login berhasil!');
                    } else if ($user->role == 'waiter') {
                        // return redirect()->route('fe.beranda')->with('success', 'Login berhasil!');
                    } else {
                        Session::flush();
                        return redirect()->route('auth.login')->with('error', 'Role tidak ditemukan!');
                    }
                } else {
                    return redirect()->back()->with('failed', 'Username atau Password salah!')->withInput();
                }
            }
        }
    }

    public function act_registrasi(Request $request)
    {
        $username = strtolower($request->username);
        $password = bcrypt($request->password);
        $pass     = $request->username;

        $dataAdd = array(
            'username' => $username,
            'password' => $password,
            'pass'     => $pass,
        );
        $validasi = $this->validate($request, [
            'username' => 'required|min:3|max:50',
            'password' => 'required|min:4|max:50',
        ]);

        if ($validasi) {
            $cekUsername = DB::table('user_autentikasi')->where('username', $username)->count();
            if ($cekUsername > 0) {
                return redirect()->back()->with('failed', 'Username tidak tersedia!')->withInput();
            } else {
                DB::table('user_autentikasi')->insert($dataAdd);
                return redirect()->route('auth.login')->with('success', 'Berhasil membuat akun!');
            }
        }
    }

    public function act_logout()
    {
        Session::flush();
        return redirect()->route('auth.login')->with('success', 'Logout berhasil!');
    }
}
