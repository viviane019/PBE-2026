<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

// POST precisa vir ANTES do GET /{id}
Route::post('/users/novo', function (Request $request) {
    $dados = $request->validate([
        'firstName' => 'required|string|min:2',
        'lastName'  => 'required|string|min:2',
        'email'     => 'required|email',
        'age'       => 'required|integer|min:1|max:120',
        'gender'    => 'required|in:male,female',
        'role'      => 'required|in:admin,moderator,user',
    ]);

    return response()->json([
        'mensagem'        => 'Usuário cadastrado com sucesso!',
        'id_gerado'       => rand(1000, 9999),
        'dados_recebidos' => $dados
    ], 201);
});

Route::get('/users/{id}', function ($id) {
    $response = Http::get("https://dummyjson.com/users/{$id}");

    if ($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status'    => 'Conectado com Sucesso!',
            'resultado' => [
                'identificador' => $dados['id'],
                'nome_completo' => $dados['firstName'] . ' ' . $dados['lastName'],
                'email'         => $dados['email'],
                'username'      => $dados['username'],
                'idade'         => $dados['age'],
                'genero'        => $dados['gender'],
                'telefone'      => $dados['phone'],
                'role'          => $dados['role'],
                'foto'          => $dados['image'],
                'empresa'       => $dados['company']['name'],
                'cargo'         => $dados['company']['title'],
            ]
        ], 200);
    }

    return response()->json(['erro' => 'Usuário não encontrado'], 404);
});

Route::get('/', function () {
    return view('welcome');
});