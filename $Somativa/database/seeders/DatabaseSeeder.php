<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesPermissionsSeeder::class, // 1. roles e permissões primeiro
            UsuarioFixoSeeder::class,       // 2. usuários vinculados aos roles
        ]);
    }
}