<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
        'nome',
        'matricula',
        'turma',
        'empresa',
        'docente',
    ];

    public function registros(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Registro::class, 'matricula', 'matricula');
    }
}
