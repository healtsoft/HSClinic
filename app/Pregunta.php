<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = [
        'pregunta', 'respuesta'
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class, 'idHC'); // FK de esta tabla
    }
}
