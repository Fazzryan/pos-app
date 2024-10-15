<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userLogin =  Session::has('login');
        if ($userLogin) {
            Session::get('user_session');
        } else {
            return redirect()->route('auth.login')->with('failed', 'Kamu belum login!');
        }
        return $next($request);
    }
}
