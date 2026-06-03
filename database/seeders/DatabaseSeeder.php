<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
    $this->call([
      RoleTableSeeder::class,
      UserTableSeeder::class,
      SliderSeeder::class,
      CategorySeeder::class,
      ProductSeeder::class
    ]);

    User::factory(20)->create();
    // Product::factory(100)->create();
    Order::factory(100)->create();
    // Create 10 orders, each with 1-5 order details
    Order::factory()
      ->count(25)
      ->has(OrderDetails::factory()->count(rand(1, 5)), 'orderDetails')
      ->create();
    // // Slider::factory(5)->create();
  }
}
