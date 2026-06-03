<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
  public function definition(): array
  {
    return [
      'slider_image' => 'https://random.imagecdn.app/1014/340',
      // 'slider_image' => $this->faker->imageUrl(800, 400, 'sliders'),
      'slider_description' => $this->faker->sentence,
    ];
  }
}
