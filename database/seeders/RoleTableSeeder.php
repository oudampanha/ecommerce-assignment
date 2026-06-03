<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
  public function run(): void
  {
    $roles = [
      [
        'id'    => 1,
        'name' => 'Admin',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id'    => 2,
        'name' => 'User',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    Role::insert($roles);
  }
}
