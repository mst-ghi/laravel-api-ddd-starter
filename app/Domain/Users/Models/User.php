<?php

namespace App\Domain\Users\Models;

use App\Infrastructure\Traits\HasStatus;
use App\Infrastructure\Traits\ModelTrait;
use App\Infrastructure\Traits\Uuid;
use App\Infrastructure\Traits\HasApiTokens;
use Illuminate\Foundation\Auth\User as BaseUserModel;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends BaseUserModel
{
    use ModelTrait, Uuid, Notifiable, HasApiTokens, HasStatus;

    protected $table = 'users';

    protected $fillable = [
        'mobile',
        'name',
    ];
}
