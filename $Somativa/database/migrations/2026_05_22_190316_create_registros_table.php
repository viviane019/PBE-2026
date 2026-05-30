<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('matricula');
            $table->string('nome_aluno');
            $table->string('turma');
            $table->string('empresa');
            $table->string('docente');
            $table->enum('tipo', ['entrada', 'saida']);
            $table->dateTime('hora');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};