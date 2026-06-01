<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|string|exists:alunos,matricula',
            'tipo'      => 'required|in:entrada,saida',
            'data'      => 'required|date_format:Y-m-d',
            'hora'      => 'required|date_format:H:i',
        ]);

        $aluno = Aluno::where('matricula', $request->matricula)->first();

        Registro::create([
            'matricula'  => $aluno->matricula,
            'nome_aluno' => $aluno->nome,
            'turma'      => $aluno->turma,
            'empresa'    => $aluno->empresa,
            'docente'    => $aluno->docente,
            'tipo'       => $request->tipo,
            'data'       => $request->data,
            'hora'       => $request->hora,
        ]);

        return redirect()->back()->with('success', 'Registro criado com sucesso');
    }

    public function historico($matricula)
    {
        $historicos = Registro::where('matricula', $matricula)->get();

        return view('registros.historico', compact('historicos'));
    }
}
