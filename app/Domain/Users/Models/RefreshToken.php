<?php

namespace App\Domain\Users\Models;

use App\Infrastructure\Traits\ModelTrait;
use App\Infrastructure\Traits\Uuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RefreshToken
 *
 * @package App\Models
 *
 * @property string $table
 * @property string $id
 * @property string $tokenable_id
 * @property string $tokenable_type
 * @property string $name
 * @property string $token
 * @property string $abilities
 * @property Carbon $last_used_at
 * @property Carbon $expires_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class RefreshToken extends Model
{
    use ModelTrait, Uuid;

    protected $table = 'refresh_tokens';

    protected $fillable = [
        'id',
        "tokenable_id",
        "tokenable_type",
        'token',
        'expires_at',
        'last_used_at',
    ];

    protected $dates = [
        'expires_at',
        'last_used_at',
        'created_at',
        'updated_at'
    ];

    public function tokenable()
    {
        return $this->morphTo();
    }

    public function hash_equals(string $known_string, string $user_string): bool
    {
        return hash_equals($known_string, $user_string);
    }
}
