<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dolor extends Model
{
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente'); // FK de esta tabla
    }
}
