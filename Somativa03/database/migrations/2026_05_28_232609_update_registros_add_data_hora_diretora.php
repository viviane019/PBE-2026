<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registros', function (Blueprint $table) {
            $table->dropColumn('hora');
            $table->date('data')->nullable();
            $table->time('hora')->nullable();
            $table->string('nome_diretora')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('registros', function (Blueprint $table) {
            $table->dropColumn(['data', 'hora', 'nome_diretora']);
            $table->dateTime('hora')->nullable();
        });
    }
};