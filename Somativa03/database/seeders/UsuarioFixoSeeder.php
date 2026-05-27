<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioFixoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Criar o usuário da Diretoria (que também cuida da Portaria)
        User::create([
            'name' => 'Fernanda Diretora',
            'email' => 'diretoria@safe.com',
            'password' => Hash::make(''), // Senha padrão para teste
            'role' => 'diretoria', // Aqui entra o nível de acesso da sua migração
        ]);

        // 2. Criar o usuário do Professor (que só visualiza)
        User::create([
            'name' => 'Professor Silva',
            'email' => 'docente@safe.com',
            'password' => Hash::make('senaisp
            '), // Senha padrão para teste
            'role' => 'professor', // Aqui entra o nível de acesso da sua migração
        ]);
    }
}