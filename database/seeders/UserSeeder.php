<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Vinicius',
            'email' => 'viniciusvgquirino@gmail.com',
            'age' => 22,
            'password' => bcrypt('12345678'),
            'cpf' => '403.642.938-88',
            'type' => 'VENDEDOR',
        ]);

        User::create([
            'name' => 'Matheus',
            'email' => 'matheus@gmail.com',
            'age' => 22,
            'password' => bcrypt('12345678'),
            'cpf' => '403.642.938-89',
            'type' => 'VENDEDOR',
        ]);
    }
}
