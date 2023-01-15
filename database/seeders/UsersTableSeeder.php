<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Create Super Admin user
        (new UsersTypeSuperAdminTableSeeder())->run();

        // Create user HR
        (new UsersTypeHRTableSeeder())->run();


        // Create managers
        (new UsersTypeManagersTableSeeder())->run();


        // Create others users
        (new UsersTypeUsersTableSeeder())->run();
    }
}
