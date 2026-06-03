<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
  public function definition(): array
  {
    return [
      'user_id' => $this->faker->numberBetween(1, 20), // Assuming 20 users
      'order_date' => $this->faker->date,
    ];
  }
}
