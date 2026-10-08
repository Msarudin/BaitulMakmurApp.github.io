<?php

namespace App\Providers;

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
        // Menggunakan 'components.sidebar' agar tepat sasaran ke folder resources/views/components/sidebar.blade.php
        \Illuminate\Support\Facades\View::composer('components.sidebar', function ($view) {
            // Menggunakan nama tabel 'bagians' sesuai perbaikan database sebelumnya
            $daftarRt = \Illuminate\Support\Facades\DB::table('bagians')->get(); 
            $view->with('daftarRt', $daftarRt);
        });
    }
}
