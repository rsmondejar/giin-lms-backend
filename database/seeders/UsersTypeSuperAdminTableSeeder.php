<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTypeSuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ], [
            'email_verified_at' => null,
            'remember_token' => null,
            'department_id' => null,
            'password' => Hash::make('password'),
            'created_at' => now(), // NOSONAR
            'updated_at' => now() // NOSONAR
        ]);

        // Add Super Admin Role
        $superadminRole = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);

        $user->roles()->sync($superadminRole->id);

        $business = Business::first();
        if (!$business) {
            $business = Business::factory()->create();
        }

        $user->incorporationDates()->updateOrCreate(
            [
                'business_id' => $business->id,
            ],
            [
                'begin_date' => (Factory::create())->dateTimeBetween('-5 years'),
            ]
        );
    }
}
