<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public static array $options = ['create', 'edit', 'update', 'show', 'delete', 'list'];
    public static array $sections = ['permissions', 'roles', 'business', 'departments', 'users', 'public holidays'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$sections as $section) {
            foreach (self::$options as $option) {
                Permission::updateOrCreate([
                    'name' => sprintf("%s %s", $option, $section),
                    'guard_name' => 'web',
                ], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
