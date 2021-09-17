<?php

namespace App\Domain\Users\Providers;

use App\Infrastructure\Contracts\Providers\BaseServiceProvider;

class DomainServiceProvider extends BaseServiceProvider
{
    protected $alias = 'users';

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
