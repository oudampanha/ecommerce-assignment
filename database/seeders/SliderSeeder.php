<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('sliders')->insert([
      [
        'slider_image' => 'storage/sliders/slider1.jpg',
        'slider_description' => 'Slider 1',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'slider_image' => 'storage/sliders/slider2.jpg',
        'slider_description' => 'Slider 2',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'slider_image' => 'storage/sliders/slider3.jpg',
        'slider_description' => 'Slider 3',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'slider_image' => 'storage/sliders/slider4.jpg',
        'slider_description' => 'Slider 4',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'slider_image' => 'storage/sliders/slider5.jpg',
        'slider_description' => 'Slider 5',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'slider_image' => 'storage/sliders/slider6.jpg',
        'slider_description' => 'Slider 6',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
