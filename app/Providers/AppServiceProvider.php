<?php

namespace App\Providers; 
// Namespace untuk service provider (tempat konfigurasi global aplikasi)

use Illuminate\Support\ServiceProvider; 
// Class dasar untuk semua service provider di Laravel

use Illuminate\Support\Facades\Gate; 
// Digunakan untuk membuat authorization (hak akses / izin)

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Tempat untuk mendaftarkan service ke container Laravel
        // Biasanya digunakan untuk binding atau dependency injection
        // Saat ini belum digunakan
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Method ini dijalankan saat aplikasi pertama kali di-load

        Gate::define('isAdmin', function ($user) {
            // Mendefinisikan gate bernama 'isAdmin'

            // Mengecek apakah user memiliki role 'admin'
            return $user->role === 'admin';
        });
    }
}