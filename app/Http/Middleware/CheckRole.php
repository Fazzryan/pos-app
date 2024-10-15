<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = session()->get('user_session')['role'];
        if ($role == 'admin') {
            return $next($request);
        }

        // Jika role adalah kasir, batasi akses ke route menu dan riwayat
        if ($role == 'kasir') {
            $currentRoute = $request->route()->getName();
            // Izinkan akses hanya ke route transaksi dan riwayat
            if (
                !str_contains($currentRoute, 'be.dashboard') &&
                !str_contains($currentRoute, 'be.transaksi.') &&
                !str_contains($currentRoute, 'be.riwayat.')
            ) {
                return redirect()->route('be.dashboard')->with('failed', 'Kamu Tidak Memiliki Hak Akses!');
            }
            return $next($request);
        }
        return redirect()->route('auth.login')->with('failed', 'Kamu Tidak Memiliki Hak Akses!');
    }
}
