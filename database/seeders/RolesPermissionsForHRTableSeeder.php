<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesPermissionsForHRTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissionIds = [];

        $hrRole = Role::firstOrCreate([
            'name' => 'hr',
            'guard_name' => 'web',
        ]);

        foreach (PermissionsTableSeeder::$sections as $section) {
            foreach (PermissionsTableSeeder::$options as $option) {
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
