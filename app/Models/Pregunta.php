<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'enunciado',
        'opcion_a',
        'opcion_b',
        'opcion_c',
        'opcion_d',
        'opcion_correcta',
        'justificacion',
        'tipo',
        'asignatura_id',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function lecturas()
    {
        return $this->belongsToMany(Lectura::class, 'lecturas_preguntas');
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
