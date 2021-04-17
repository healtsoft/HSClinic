<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    public function pacientes()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente'); // FK de esta tabla
    }
}


