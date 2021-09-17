<?php

use App\Domain\Users\Models\Admin;
use App\Domain\Users\Models\Permission;
use App\Domain\Users\Models\Role;
use Illuminate\Support\Facades\DB;

class AclSeeder extends DBSeeder
{
    public $table;
    protected $permission_table;
    protected $permission_role_table;
    protected $roles;
    protected $panel_permissions;
    protected $mobile_permissions;

    /**
     * RolePermissionSeeder constructor.
     */
    public function __construct()
    {
        $this->table = config('acl.roles_table');
        $this->permission_table = config('acl.permissions_table');
        $this->permission_role_table = config('acl.permission_role_table');
        $this->panel_permissions = config('acl.panel_permissions');
        $this->mobile_permissions = config('acl.mobile_permissions');
        $this->roles = config('acl.roles');
    }


    /**
     * Roles
     *
     * @return array()
     */
    public function roles()
    {
        return $this->roles;
    }

    /**
     * Panel Permissions
     *
     * @param string $name
     *
     * @return bool|string
     */
    public function panel_permissions(string $name = '')
    {
        $flag = false;
        if ($this->panel_permissions)
            foreach ($this->panel_permissions as $modules)
                if (in_array($name, $modules['perms'])) $flag = $name;
        return $flag;
    }

    /**
     * Mobile Permissions
     *
     * @param string $name
     *
     * @return bool|string
     */
    public function mobile_permissions(string $name = '')
    {
        $flag = false;
        if ($this->mobile_permissions)
            foreach ($this->mobile_permissions as $modules)
                if (in_array($name, $modules['perms'])) $flag = $name;
        return $flag;
    }


    /**
     * Run the Seeder
     *
     * @return void
     */
    public function run()
    {
        $this->foreignKeyChecks();
        $this->emptyTable($this->permission_role_table);
        $this->emptyTable($this->permission_table);
        $this->emptyTable($this->table);

        foreach ($this->panel_permissions as $modules) {
            foreach ($modules['perms'] as $item) {
                $permission = new Permission();
                $permission->module = $modules['module'];
                $permission->name = $item;
                $permission->label = trans('permissions.panel.' . $item);
                $permission->save();
            }
        }

        foreach ($this->mobile_permissions as $modules) {
            foreach ($modules['perms'] as $item) {
                $permission = new Permission();
                $permission->module = $modules['module'];
                $permission->name = $item;
                $permission->label = trans('permissions.panel.' . $item);
                $permission->save();
            }
        }

        foreach ($this->roles() as $key => $val) {
            $this->command->info('Creating/updating the \'' . $key . '\' role');
            $val['name'] = $key;
            $this->reset($val);
        }
    }


    /**
     * Reset Role, Permissions & Admins
     *
     * @param  $role
     *
     * @return void
     */
    public function reset($role)
    {
        $commandBullet = '  -> ';

        // The Old Role
        $originalRole = Role::where('name', $role['name'])->first();
        if ($originalRole) Role::where('id', $originalRole->id)->update(['name' => $role['name'] . '__remove']);

        // The New Role
        $newRole = new Role();
        $newRole->name = $role['name'];
        if (isset($role['label'])) $newRole->label = $role['label'];
        if (isset($role['description'])) $newRole->description = $role['description'];
        if (isset($role['delete_able'])) $newRole->delete_able = $role['delete_able'];
        $newRole->save();
        $this->command->info($commandBullet . "Created $role[name] role");

        // Set the Permissions (if they exist)
        $pcount = 0;
        if (!empty($role['permissions'])) {
            foreach ($role['permissions'] as $modules) {

                foreach ($modules['perms'] as $permission_name) {

                    $panel_permissions = $this->panel_permissions($permission_name);
                    $mobile_permissions = $this->mobile_permissions($permission_name);
                    if (
                        ($panel_permissions === false && $mobile_permissions === false) ||
                        ($panel_permissions === true && $mobile_permissions === true) ||
                        (!$permission_name)
                    ) {
                        $this->command->error($commandBullet . "Failed to attach permission '$permission_name'. It does not exist");
                        continue;
                    }

                    $newPermission = Permission::where('name', $permission_name)->first();

                    $newRole->attachPermission($newPermission);
                    $pcount++;
                }
            }
        }
        $this->command->info($commandBullet . "Attached $pcount permissions to $role[name] role");

        // Update old records
        if ($originalRole) {
            $adminCount = 0;
            $RoleAdmins = DB::table(config('acl.role_admin_table'))->where('role_id', $originalRole->id)->get();
            foreach ($RoleAdmins as $admin) {
                $u = Admin::where('id', $admin->admin_id)->first();
                $u->attachRole($newRole);
                $adminCount++;
            }
            $this->command->info($commandBullet . "Updated role attachment for $adminCount admins");

            Role::where('id', $originalRole->id)->delete(); // will also remove old role_admin records
            $this->command->info($commandBullet . "Removed the original $role[name] role");
        }
    }


    /**
     * Cleanup()
     * Remove any roles & permissions that have been removed
     *
     * @return void
     */
    public function cleanup()
    {
        $commandBullet = '  -> ';
        $this->command->info('Cleaning up roles & permissions:');

        $storedRoles = Role::all();
        if (!empty($storedRoles)) {
            $definedRoles = $this->roles();
            foreach ($storedRoles as $role) {
                if (!array_key_exists($role->name, $definedRoles)) {
                    Role::where('name', $role->name)->delete();
                    $this->command->info($commandBullet . 'The \'' . $role->name . '\' role was removed');
                }
            }
        }
        $storedPerms = DB::table(config('acl.permissions_table'))->get();
        if (!empty($storedPerms)) {
            $definedPerms = $this->panel_permissions();
            foreach ($storedPerms as $perm) {
                if (!array_key_exists($perm->name, $definedPerms)) {
                    DB::table(config('acl.permissions_table'))->where('name', $perm->name)->delete();
                    $this->command->info($commandBullet . 'The \'' . $perm->name . '\' permission was removed');
                }
            }
            $definedPerms = $this->mobile_permissions();
            foreach ($storedPerms as $perm) {
                if (!array_key_exists($perm->name, $definedPerms)) {
                    DB::table(config('acl.permissions_table'))->where('name', $perm->name)->delete();
                    $this->command->info($commandBullet . 'The \'' . $perm->name . '\' permission was removed');
                }
            }
        }
        $this->command->info($commandBullet . 'Done');
        $this->command->info(" ");
    }

    public function __destruct()
    {
        $this->writeln(self::DB_INSERT, "data was added in the \"$this->table\" table");
        $this->writeln(self::DB_INSERT, "data was added in the \"$this->permission_table\" table");
        $this->writeln(self::DB_INSERT, "data was added in the \"$this->permission_role_table\" table");
    }
}
