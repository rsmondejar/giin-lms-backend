<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ManagerUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $totalManagersPerDepartment = 3;
        $businesses = Business::all();
        $departments = Department::all();

        $managerRole = 'managers';
        $role = Role::where('name', $managerRole)->first();
        if (is_null($role)) {
            $role = Role::create([
                'name' => $managerRole,
                'guard_name' => 'web',
            ]);
        }

        $index = 0;
        /** @var Business $business */
        foreach ($businesses as $business) {
            /** @var Department $department */
            foreach ($departments as $department) {
                for ($i = 0; $i < $totalManagersPerDepartment; $i++) {
                    $displayName = "Manager " . str_pad($index, 3, '0', STR_PAD_LEFT);

                    $user = User::factory()->create([
                        'name' => $displayName,
                        'email' => Str::slug($displayName, '.') . '@example.com',
                        'email_verified_at' => null,
                        'password' => Hash::make('password'),
                        'remember_token' => null,
                        'business_id' => $business->id,
                        'department_id' => $department->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $index++;

                    // Assign role "managers"
                    $user->roles()->sync($role->id);
                }
            }
        }
    }
}
