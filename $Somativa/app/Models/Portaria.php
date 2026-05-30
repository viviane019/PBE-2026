<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portaria extends Model
{
    protected $table = 'portarias';

    protected $fillable = [
        'registro_id',
        'tipo',
        'status',
        'data_hora',
    ];
}
