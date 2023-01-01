<?php

namespace Database\Factories;

use App\Models\PublicHoliday;
use Illuminate\Database\Eloquent\Factories\Factory;


class PublicHolidayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicHoliday::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('now', '2 years');

        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 191)),
            'date' => $date->format('Y-m-d'),
            'year' => $date->format('Y'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'), // NOSONAR
            'updated_at' => $this->faker->date('Y-m-d H:i:s'), // NOSONAR
            'deleted_at' => $this->faker->date('Y-m-d H:i:s') // NOSONAR
        ];
    }
}
