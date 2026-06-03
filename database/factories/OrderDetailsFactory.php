<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderDetailsFactory extends Factory
{
  protected $model = \App\Models\OrderDetails::class;
  public function definition(): array
  {
    return [
      'order_id' => \App\Models\Order::factory(), // Links to the OrderFactory
      'product_id' => $this->faker->numberBetween(1, 19), // Assuming you have 100 products
      'qty' => $this->faker->numberBetween(1, 10),
    ];
  }
}
