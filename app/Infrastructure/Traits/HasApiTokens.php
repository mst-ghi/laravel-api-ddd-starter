<?php

namespace App\Infrastructure\Traits;

use App\Domain\Users\Models\RefreshToken;
use Illuminate\Support\Str;

/**
 * Trait HasApiTokens
 *
 * @package App\Traits
 *
 * @property string $id
 *
 * @property RefreshToken[] $token
 *
 */
trait HasApiTokens
{
    protected $access_token;

    protected $refresh_token;

    public function token()
    {
        return $this->morphMany(RefreshToken::class, 'tokenable');
    }

    public function createTokens()
    {
        $data = [
            'token' => hash('sha256', $plainTextToken = Str::random(128)),
            'expires_at' => jwtRefreshTokenExpiresAt()
        ];

        $this->token()->create($data);

        $this->refresh_token = $plainTextToken;
        $this->access_token = jwtEncode($this->id);

        return [
            'access_token' => $this->access_token,
            'refresh_token' => $this->refresh_token,
        ];
    }
}
