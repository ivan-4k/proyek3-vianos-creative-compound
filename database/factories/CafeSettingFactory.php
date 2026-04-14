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
        $openingTime = $this->faker->time('H:i', '06:00');
        $closingTime = $this->faker->time('H:i', '22:00');

        return [
            'opening_time' => $openingTime,
            'closing_time' => $closingTime,
            'is_open' => $this->faker->boolean(85),
            'is_order_open' => $this->faker->boolean(90),
        ];
    }
}
