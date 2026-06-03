<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
  public function definition(): array
  {
    return [
      'category_id' => $this->faker->numberBetween(1, 10), // Assuming 10 categories
      'product_name' => $this->faker->word,
      'product_description' => $this->faker->paragraph,
      'qty' => $this->faker->numberBetween(1, 100),
      'price' => $this->faker->randomFloat(2, 10, 1000),
      'star' => $this->faker->randomFloat(1, 1, 5),
      'time_value' => $this->faker->numberBetween(1, 24),
      'product_image' => 'https://random.imagecdn.app/1014/340',
      // 'product_image' => $this->faker->imageUrl(400, 400, 'products'),
    ];
  }
}
