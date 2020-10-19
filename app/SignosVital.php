<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignosVital extends Model
{
    protected $fillable = [
        'temperatura', 'pulso', 'frecuenciaRespiratoria', 'presionSistolica',
        'presionDiastolica', 'glucosa'
    ];

    public function paciente ()
    {
        return $this->belongsTo(Paciente::class);
    }
}
