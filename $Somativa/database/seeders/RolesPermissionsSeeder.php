<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpa o cache de permissões antes de qualquer coisa
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ── PERMISSÕES ────────────────────────────────────────────
        $permissions = [
            // Alunos
            'ver_alunos',
            'criar_aluno',
            'editar_aluno',
            'excluir_aluno',

            // Registros de entrada/saída
            'ver_registros',
            'criar_registro',
            'editar_registro',
            'excluir_registro',

            // Portaria
            'ver_portaria',
            'confirmar_saida',

            // Aprovação pelo professor
            'aprovar_registro',

            // Docentes
            'ver_docentes',
            'criar_docente',
            'editar_docente',
            'excluir_docente',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // ── ROLE: diretoria (acesso total) ────────────────────────
        $diretoria = Role::firstOrCreate(['name' => 'diretoria', 'guard_name' => 'web']);
        $diretoria->syncPermissions($permissions);

        // ── ROLE: professor (acesso restrito) ─────────────────────
        $professor = Role::firstOrCreate(['name' => 'professor', 'guard_name' => 'web']);
        $professor->syncPermissions([
            'ver_portaria',
            'aprovar_registro',
        ]);

        $this->command->info('Roles e permissões criados com sucesso.');
    }
}
