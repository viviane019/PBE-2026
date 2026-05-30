<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'      => 'required|string|max:255',
            'matricula' => 'nullable|string|max:50',
            'email'     => 'nullable|email|max:255',
            'telefone'  => 'nullable|string|max:20',
        ]);

        Docente::create($validated);

        return redirect()->route('docentes.index');
    }
}