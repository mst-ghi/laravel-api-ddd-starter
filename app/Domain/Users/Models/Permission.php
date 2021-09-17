<?php

namespace App\Domain\Users\Models;

use App\Infrastructure\Contracts\Acl\PermissionInterface;
use App\Infrastructure\Contracts\Acl\PermissionTrait;
use App\Infrastructure\Traits\ModelTrait;
use App\Infrastructure\Traits\Uuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package App\Models
 *
 * @mixin Builder
 *
 * @property string $id
 * @property string $module
 * @property string $name
 * @property string $label
 *
 * @property Role[] $roles
 */
class Permission extends Model implements PermissionInterface
{
    use ModelTrait, Uuid, PermissionTrait;

    protected $table = 'permissions';

    protected $fillable = [
        'id',
        'module',
        'name',
        'label',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('acl.permissions_table');
    }

    public static function userPerms($user_id = null)
    {
        $user_id = $user_id ?? auth()->id();

        return self::whereExists(function ($query) use ($user_id) {
            $query->from('permission_role')
                ->selectRaw('Null')
                ->whereRaw('permission_role.permission_id = permissions.id')
                ->whereExists(function ($query) use ($user_id) {
                    $query->from('role_user')
                        ->selectRaw('Null')
                        ->whereRaw('role_user.role_id = permission_role.role_id')
                        ->whereExists(function ($query) use ($user_id) {
                            $query->from('users')
                                ->selectRaw('Null')
                                ->whereRaw('role_user.user_id = users.id')
                                ->whereRaw("users.id = '$user_id'");
                        });
                });
        })->select(['label'])->get()->pluck('label');
    }
}
