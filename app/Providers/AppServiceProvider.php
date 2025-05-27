<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Pagination\Paginator;

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
        
        // Kode sebelumnya (dikomentari)
        /*
        //
        */

        // Matikan hash password sementara
        Auth::provider('eloquent', function ($app, $config) {
            return new class($app['hash'], $config['model']) extends EloquentUserProvider {
                public function validateCredentials($user, array $credentials)
                {
                    return $credentials['password'] === $user->getAuthPassword();
                }
            };
        });

        Paginator::useBootstrap();
    }
}
