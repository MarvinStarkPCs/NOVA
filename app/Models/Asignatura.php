<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function lecturas()
    {
        return $this->hasMany(Lectura::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
