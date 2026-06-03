<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('categories')->insert([
      [
        'name' => 'Pizza',
        'description' => 'Pizza',
        'category_image' => 'storage/categories/pizza.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Burger',
        'description' => 'Burger',
        'category_image' => 'storage/categories/burger.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Chicken',
        'description' => 'Chicken',
        'category_image' => 'storage/categories/chicken.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Sushi',
        'description' => 'Sushi',
        'category_image' => 'storage/categories/sushi.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Meat',
        'description' => 'Meat',
        'category_image' => 'storage/categories/meat.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Hotdog',
        'description' => 'Hotdog',
        'category_image' => 'storage/categories/hotdog.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Drink',
        'description' => 'Drink',
        'category_image' => 'storage/categories/drink.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Coffee',
        'description' => 'Coffee',
        'category_image' => 'storage/categories/coffee.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'More',
        'description' => 'More',
        'category_image' => 'storage/categories/more.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
