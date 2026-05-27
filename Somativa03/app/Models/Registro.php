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

    // Nome simplificado para o Filament V2 reconhecer a relação direto pela matrícula
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'matricula', 'matricula');
    }
}