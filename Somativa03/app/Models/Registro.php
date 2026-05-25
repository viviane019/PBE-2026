<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [

        'matricula',
        'aluno',
        'turma',
        'empresa',
        'docente',
        'tipo',
        'data',
        'horario',
        'diretoria',
        'status',
        'declaracao',
        'motivo',
        'observacao',

    ];

    // relacionamento pela matrícula
    public function alunoRelacionamento()
    {
        return $this->belongsTo(Aluno::class, 'matricula', 'matricula');
    }
}