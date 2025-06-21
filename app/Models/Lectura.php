<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lectura extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'contenido', 'asignatura_id'];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function preguntas()
    {
        return $this->belongsToMany(Pregunta::class, 'lecturas_preguntas');
    }
}
