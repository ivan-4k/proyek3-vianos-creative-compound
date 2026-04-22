<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CafeSetting>
 */
class CafeSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'weekday_opening_time' => '09:00:00',
            'weekday_closing_time' => '02:00:00',

            'weekend_opening_time' => '08:00:00',
            'weekend_closing_time' => '02:00:00',

            'is_open' => $this->faker->boolean(90),
            'is_order_open' => $this->faker->boolean(85),
        ];
    }
}
