<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTypeManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $totalManagersPerDepartment = 1;
        $businesses = Business::all();
        $departments = Department::all();

        $role = Role::firstOrCreate([
            'name' => 'managers',
            'guard_name' => 'web',
        ]);

        $index = 0;
        /** @var Business $business */
        foreach ($businesses as $business) {
            /** @var Department $department */
            foreach ($departments as $department) {
                for ($i = 0; $i < $totalManagersPerDepartment; $i++) {
                    $displayName = "Manager " . str_pad($index, 3, '0', STR_PAD_LEFT);

                    $user = User::updateOrCreate([
                        'email' => Str::slug($displayName, '.') . '@example.com',
                    ], [
                        'name' => $displayName,
                        'email_verified_at' => null,
                        'password' => Hash::make('password'),
                        'remember_token' => null,
                        'department_id' => $department->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Add Incorporation Date
                    $user->incorporationDates()->updateOrCreate(
                        [
                            'business_id' => $business->id,
                        ],
                        [
                            'begin_date' => (Factory::create())->dateTimeBetween('-5 years'),
                        ]
                    );

                    // Assign role "managers"
                    $user->roles()->sync($role->id);

                    $index++;
                }
            }
        }
    }
}
