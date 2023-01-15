<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesPermissionsForManagersTableSeeder extends Seeder
{
    public static array $options = ['show', 'list'];
    public static array $sections = ['users', 'public holidays'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissionIds = [];

        $hrRole = Role::firstOrCreate([
            'name' => 'managers',
            'guard_name' => 'web',
        ]);

        foreach (self::$sections as $section) {
            foreach (self::$options as $option) {
                $permission = Permission::firstOrCreate([
                    'name' => sprintf("%s %s", $option, $section),
                    'guard_name' => 'web',
                ]);

                $permissionIds[] = $permission->id;
            }
        }

        $hrRole->permissions()->sync($permissionIds);
    }
}
