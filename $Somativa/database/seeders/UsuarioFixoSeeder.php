<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioFixoSeeder extends Seeder
{
    public function run(): void
    {
        $diretor = User::firstOrCreate(
            ['email' => 'diretoria@safe.com'],
            [
                'name'     => 'Fernanda Diretora',
                'password' => Hash::make('senaisp'),
                'role'     => 'diretoria',
            ]
        );
        $diretor->syncRoles('diretoria');

        $professor = User::firstOrCreate(
            ['email' => 'docente@safe.com'],
            [
                'name'     => 'Professor Silva',
                'password' => Hash::make('senaisp'),
                'role'     => 'professor',
            ]
        );
        $professor->syncRoles('professor');

        $this->command->info('Usuários criados: diretoria@safe.com / docente@safe.com (senha: senaisp)');
    }
}