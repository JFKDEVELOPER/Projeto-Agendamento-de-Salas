<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloco_id')->constrained()->onDelete('cascade');
            $table->string('nome'); // Apenas nome
            $table->integer('capacidade');
            $table->enum('tipo', ['aula', 'laboratorio', 'auditorio'])->nullable();
            $table->json('recursos')->nullable();
            $table->enum('status', ['disponivel', 'ocupada', 'manutencao'])->default('disponivel');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salas');
    }
};
