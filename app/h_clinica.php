<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class h_clinica extends Model
{
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
