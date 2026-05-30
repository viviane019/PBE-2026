<?php

namespace App\Enums;

enum UserRole: string
{
    case Diretoria = 'diretoria';
    case Professor = 'professor';
    case Docente   = 'docente';
}
