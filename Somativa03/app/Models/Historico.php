<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = [
        'aluno',
        'matricula',
        'turma',
        'empresa',
        'docente',
        'tipo',
        'data',
        'horario',
        'possui_declaracao',
        'motivo',
        'observacoes',
        'diretor_responsavel',
        'status',
    ];
}