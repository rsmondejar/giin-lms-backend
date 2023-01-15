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

class UsersTypeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        $businesses = Business::all();
        $departments = Department::all();

        $role = Role::firstOrCreate([
            'name' => 'users',
            'guard_name' => 'web',
        ]);

        /** @var Business $business */
        foreach ($businesses as $business) {
            /** @var Department $department */
            foreach ($departments as $department) {
                $totalUsersPerDepartment = $faker->numberBetween(2, 10);
                for ($i = 0; $i < $totalUsersPerDepartment; $i++) {
                    $displayName = $faker->firstName . ' ' . $faker->lastName;

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

                    $user->roles()->sync($role->id);
                }
            }
        }
    }
}
