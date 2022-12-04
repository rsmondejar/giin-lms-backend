<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Business;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $business = Business::inRandomOrder()->first();
        if (!$business) {
            $business = Business::factory()->create();
        }

        $department = Department::inRandomOrder()->first();
        if (!$department) {
            $department = Department::factory()->create();
        }

        $displayName = $this->faker->firstName . ' ' . $this->faker->lastName;

        return [
            'name' => $displayName,
            'email' => Str::slug($displayName, '.').'@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('password'),
            'remember_token' => null,
            'business_id' => $business->id,
            'department_id' => $department->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'), // NOSONAR
            'updated_at' => $this->faker->date('Y-m-d H:i:s') // NOSONAR
        ];
    }
}
