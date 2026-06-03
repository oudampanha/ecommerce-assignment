<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user1 = User::create([
      'name'           => 'Super Admin',
      'username'       => 'supperadmin',
      'email'          => 'admin@login.com',
      'phone'       => '078343143',
      'password'       => bcrypt('12345678'),
      'role_id' => 1,
      'remember_token' => null,
    ]);
    $user1->createToken('auth_token')->plainTextToken;
    $user2 = User::create([
      'name'           => 'Customer',
      'username'       => 'customer',
      'email'          => 'customer@login.com',
      'phone'       => '012555666',
      'password'       => bcrypt('12345678'),
      'role_id' => 2,
      'remember_token' => null,
    ]);
    $user2->createToken('auth_token')->plainTextToken;
  }
}