<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosTto extends Model
{
    protected $fillable = [
        'dxMedico', 'dxFisio', 'codigoCie', 'tratamiento',
        'objetivoTto', 'comentarios', 'numeroSesiones'
    ];
}
