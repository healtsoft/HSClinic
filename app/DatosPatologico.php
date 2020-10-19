<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosPatologico extends Model
{
    protected $fillable = [
        'enfermedades', 'heredofamiliares', 'medicamentos', 'cirugias',
        'tipoBandera', 'alcohol', 'cigarro', 'drogas',
        'fracturas'
    ];
}
