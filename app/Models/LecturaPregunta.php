<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LecturaPregunta extends Pivot
{
    protected $table = 'lecturas_preguntas';

    public $timestamps = false;
}

