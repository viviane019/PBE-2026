<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'nome_aluno',
        'matricula',
        'turma',
        'empresa',
        'tipo',
        'data',
        'hora',
        'docente',
        'nome_diretora',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'matricula', 'matricula');
    }
}