<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pregunta_id',
        'opcion_elegida',
        'respuesta_correcta',
        'fecha_respuesta',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
