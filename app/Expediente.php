<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente'); // FK de esta tabla
    }
}
