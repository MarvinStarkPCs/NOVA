<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Marvin Santos',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // Administrador
        ]);

        User::factory(5)->create([
            'role_id' => 3, // Estudiantes
        ]);
    }
}
