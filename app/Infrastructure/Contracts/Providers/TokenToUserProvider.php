<?php

namespace App\Infrastructure\Contracts\Providers;

use App\Domain\Users\Models\RefreshToken;
use App\Domain\Users\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;

class TokenToUserProvider implements UserProvider
{
    protected $token;
    private $user;

    public function __construct(User $user, RefreshToken $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function retrieveById($identifier)
    {
        return $this->user->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return User::find(jwtDecode($token)->sub) ?? null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // update via remember token not necessary
    }

    public function retrieveByCredentials(array $credentials)
    {
        $user = $this->user;
        foreach ($credentials as $credentialKey => $credentialValue)
            if (!Str::contains($credentialKey, 'password'))
                $user->where($credentialKey, $credentialValue);
        return $user->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];
        return app('hash')->check($plain, $user->getAuthPassword());
    }
}
