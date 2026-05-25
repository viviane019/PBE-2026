<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Aluno;

class RegistroController extends Controller
{
    public function store(Request $request)
    {
        // procura aluno pela matrícula
        $aluno = Aluno::where('matricula', $request->matricula)->first();

        if (!$aluno) {
            return back()->with('error', 'Aluno não encontrado');
        }

        Registro::create([

            'matricula'   => $aluno->matricula,
            'aluno'       => $aluno->nome,
            'turma'       => $aluno->turma,
            'empresa'     => $aluno->empresa,
            'docente'     => $aluno->docente,

            'tipo'        => $request->tipo,
            'data'        => $request->data,
            'horario'     => $request->horario,
            'diretoria'   => $request->diretoria,
            'status'      => $request->status,
            'declaracao'  => $request->declaracao,
            'motivo'      => $request->motivo,
            'observacao'  => $request->observacao,

        ]);

        return redirect()->back()->with('success', 'Registro criado com sucesso');
    }

    public function historico($matricula)
    {
        $historicos = Registro::where('matricula', $matricula)->get();

        return view('registros.historico', compact('historicos'));
    }
}