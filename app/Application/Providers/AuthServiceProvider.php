<?php

namespace App\Application\Providers;

use App\Infrastructure\Contracts\Guards\AccessTokenGuard;
use App\Infrastructure\Contracts\Providers\TokenToAdminProvider;
use App\Infrastructure\Contracts\Providers\TokenToUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('jwt-user', function ($app, $name, array $config) {
            return new AccessTokenGuard(
                app(TokenToUserProvider::class),
                app('request'),
                $config
            );
        });

        Auth::extend('jwt-admin', function ($app, $name, array $config) {
            return new AccessTokenGuard(
                app(TokenToAdminProvider::class),
                app('request'),
                $config
            );
        });
    }
}
