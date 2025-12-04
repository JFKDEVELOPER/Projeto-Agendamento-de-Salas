<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    if (!Schema::hasTable('reservas')) {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('sala_id')->constrained('salas')->onDelete('cascade');
            $table->timestamps();
        });
    }
}


    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
