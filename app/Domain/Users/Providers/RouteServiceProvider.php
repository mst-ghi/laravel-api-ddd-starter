<?php

namespace App\Domain\Users\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;


class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Domain\Users\Http\Controllers';

    public function boot()
    {
        //

        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->namespace($this->namespace)
            ->group(domainPath($this, 'Routes/api.php'));
    }
}
