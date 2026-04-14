<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'id_kategori' => Category::inRandomOrder()->first()?->id_kategori ?? Category::factory(),
            'name' => ucfirst($name),
            'slug' => str($name)->slug(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(10000, 100000),
            'stock' => $this->faker->numberBetween(0, 50),
            'main_image' => $this->faker->imageUrl(640, 480, 'coffee'),
            'is_available' => $this->faker->boolean(85),
        ];
    }
}
