<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portarias', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('registro_id')->index();

            $table->string('tipo')->nullable(); // entrada/saida
            $table->string('status')->nullable();

            $table->dateTime('data_hora')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portarias');
    }
};