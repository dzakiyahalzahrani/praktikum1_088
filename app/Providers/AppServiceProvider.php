<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;

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
        // 1. Konfigurasi Rute Scramble
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });

        // 2. Konfigurasi Skema Keamanan (Bearer Token) untuk API
        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer')
            );
        });

        // Gate untuk menyembunyikan menu Product secara umum
        Gate::define('manage-product', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate khusus untuk fitur Export (Instruksi Kelas B)
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-category', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('viewApiDocs', function () {
            return true;
        });
    }
}