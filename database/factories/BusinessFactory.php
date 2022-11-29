<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;


class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'business_name' => $this->faker->text($this->faker->numberBetween(5, 60)),
            'address' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'city' => $this->faker->text($this->faker->numberBetween(5, 60)),
            'postal_code' => $this->faker->text($this->faker->numberBetween(5, 10)),
            'country' => $this->faker->text($this->faker->numberBetween(5, 60)),
            'phone' => $this->faker->numerify('0##########'),
            'email' => $this->faker->email,
            'website' => $this->faker->text($this->faker->numberBetween(5, 100)),
            'logo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
