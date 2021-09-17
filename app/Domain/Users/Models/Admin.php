<?php

namespace App\Domain\Users\Models;

use App\Infrastructure\Traits\HasStatus;
use App\Infrastructure\Traits\ModelTrait;
use App\Infrastructure\Traits\Uuid;
use App\Infrastructure\Traits\HasApiTokens;
use Illuminate\Foundation\Auth\User as BaseUserModel;
use Illuminate\Notifications\Notifiable;

/**
 * Class Admin
 *
 * @package App\Models
 *
 * @property string $mobile
 * @property string $name
 * @property string $password
 */
class Admin extends BaseUserModel
{
    use ModelTrait, Uuid, Notifiable, HasApiTokens, HasStatus;

    protected $table = 'admins';

    protected $fillable = [
        'mobile',
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
