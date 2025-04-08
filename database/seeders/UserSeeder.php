<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Usuario administrador',
            'email' => 'administrador@email.com',
            'role_id' => 1,
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Usuario recepcionista',
            'email' => 'recepcionista@email.com',
            'role_id' => 2,
            'password' => Hash::make('password'),
        ]);
    }
}
