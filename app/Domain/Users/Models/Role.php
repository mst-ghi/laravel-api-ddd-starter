<?php

namespace App\Domain\Users\Models;

use App\Infrastructure\Contracts\Acl\RoleInterface;
use App\Infrastructure\Contracts\Acl\RoleTrait;
use App\Infrastructure\Traits\ModelTrait;
use App\Infrastructure\Traits\Uuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App\Models\User
 *
 * @mixin Builder
 *
 * @property string $id
 * @property string $name
 * @property string $label
 * @property string $description
 * @property boolean $delete_able
 *
 * @property Permission[] $permissions
 *
 */
class Role extends Model implements RoleInterface
{
    use ModelTrait, Uuid, RoleTrait;

    const ROLE_PANEL_API = 'panel_api';
    const ROLE_Mobile_API = 'mobile_api';
    const ROLE_TYPE_LIST = [
        self::ROLE_PANEL_API,
        self::ROLE_Mobile_API,
    ];

    protected $fillable = [
        'id',
        'name',
        'label',
        'description',
        'delete_able'
    ];

    const With = ['users', 'permissions'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('acl.roles_table');
    }

    public function permissions()
    {
        return $this->belongsToMany(
            config('acl.permission'),
            config('acl.permission_role_table'),
            config('acl.role_foreign_key'),
            config('acl.permission_foreign_key')
        );
    }


}
