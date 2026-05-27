<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\DocenteController;

Route::get('/', function () {
    return redirect('/admin/login');
});

// REGISTROS
Route::post('/registros', [RegistroController::class, 'store'])
    ->name('registros.store');

Route::get('/historico/{matricula}', [RegistroController::class, 'historico'])
    ->name('registros.historico');

// DOCENTES
Route::get('/docentes', [DocenteController::class, 'index'])
    ->name('docentes.index');

Route::get('/docentes/create', [DocenteController::class, 'create'])
    ->name('docentes.create');

Route::post('/docentes', [DocenteController::class, 'store'])
    ->name('docentes.store');