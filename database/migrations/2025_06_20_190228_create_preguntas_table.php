<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->text('enunciado');
            $table->text('opcion_a');
            $table->text('opcion_b');
            $table->text('opcion_c');
            $table->text('opcion_d');
            $table->enum('opcion_correcta', ['A', 'B', 'C', 'D']); // ← ✅ Cambiado aquí
            $table->text('justificacion');
            $table->string('tipo', 50);
            $table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
