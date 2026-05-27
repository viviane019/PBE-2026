<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar o usuário da Diretoria / Portaria
        User::create([
            'name' => 'Fernanda Diretoria',
            'email' => 'diretoria@safe.com',
            'password' => Hash::make('senaisp'), // Nova senha padrão
            'role' => 'diretoria', 
        ]);

        // 2. Criar o usuário do Professor (Docente)
        User::create([
            'name' => 'Professor Silva',
            'email' => 'docente@safe.com',
            'password' => Hash::make('senaisp'), // Nova senha padrão
            'role' => 'professor', 
        ]);
    }
}