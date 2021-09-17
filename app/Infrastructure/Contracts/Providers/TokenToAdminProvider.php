<?php

namespace App\Infrastructure\Contracts\Providers;

use App\Domain\Users\Models\RefreshToken;
use App\Domain\Users\Models\Admin;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as AdminProvider;
use Illuminate\Support\Str;

class TokenToAdminProvider implements AdminProvider
{
    protected $token;
    private $admin;

    public function __construct(Admin $admin, RefreshToken $token)
    {
        $this->admin  = $admin;
        $this->token = $token;
    }

    public function retrieveById($identifier)
    {
        return $this->admin->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return Admin::find(jwtDecode($token)->sub) ?? null;
    }

    public function updateRememberToken(Authenticatable $admin, $token)
    {
        // update via remember token not necessary
    }

    public function retrieveByCredentials(array $credentials)
    {
        $admin = $this->admin;
        foreach ($credentials as $credentialKey => $credentialValue)
            if (!Str::contains($credentialKey, 'password'))
                $admin->where($credentialKey, $credentialValue);
        return $admin->first();
    }

    public function validateCredentials(Authenticatable $admin, array $credentials)
    {
        $plain = $credentials['password'];
        return app('hash')->check($plain, $admin->getAuthPassword());
    }
}
