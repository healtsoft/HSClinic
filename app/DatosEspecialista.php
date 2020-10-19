<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosEspecialista extends Model
{
    protected $fillable = [
        'fotoUrl', 'domicilio', 'fechaNacimiento', 'suscripcion',
        'expiracion'
    ];
}
