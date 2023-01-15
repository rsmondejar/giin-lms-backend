<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Create permissions
        (new PermissionsTableSeeder())->run();

        // Create roles
        (new RolesTableSeeder())->run();

        // Roles Permissions for HR
        (new RolesPermissionsForHRTableSeeder())->run();

        // Roles Permissions for Managers
        (new RolesPermissionsForManagersTableSeeder())->run();

        // Roles Permissions for Users
        (new RolesPermissionsForUsersTableSeeder())->run();

        // Create Businesses
//        (new BusinessesTableSeeder())->run();

        // Create Departments
//        (new DepartmentsTableSeeder())->run();

        // Create Public Holidays current year
//        (new PublicHolidayTableSeeder())->run();

        // Create Users
        (new UsersTableSeeder())->run();
    }
}
