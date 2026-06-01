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
        'confirmado',
    ];

    protected $casts = [
        'confirmado' => 'boolean',
        'data'       => 'date',
    ];

    public function aluno(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Aluno::class, 'matricula', 'matricula');
    }
}
