<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  public function definition(): array
  {
    return [
      'name' => $this->faker->name,
      'username' => $this->faker->unique()->userName,
      'email' => $this->faker->unique()->safeEmail,
      'phone' => $this->faker->phoneNumber,
      'email_verified_at' => now(),
      'password' => bcrypt('12345678'),
      'address' => $this->faker->address,
      'profile_image' => $this->faker->imageUrl(200, 200, 'people'),
      'remember_token' => Str::random(10),
      'role_id' => 2, // Assuming 5 roles
      // 'role_id' => $this->faker->numberBetween(1, 5), // Assuming 5 roles
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static
  {
    return $this->state(fn(array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
