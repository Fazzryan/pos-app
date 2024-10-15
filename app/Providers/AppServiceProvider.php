<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        // Menggunakan view composer untuk mengirim data ke view yang berisi navbar
        View::composer('be.layouts.app_navbar', function ($view) {
            // Ambil data user dari Auth, meskipun tanpa model
            $userId = session()->get('user_session')['user_id'];
            $user = DB::table('user')->where('id', $userId)->first();
            $username = $user ? $user->nm_lengkap : 'Guest';

            $date = date("Y-m-d");
            $dateNow = Carbon::parse($date)->translatedFormat('d F Y');

            $view->with([
                'username' => $username,
                'dateNow' => $dateNow,
            ]);
        });
    }
}
