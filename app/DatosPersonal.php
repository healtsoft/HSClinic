<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosPersonal extends Model
{
    protected $fillable = [
        'fotoUrl', 'domicilio', 'sexo', 'estadoCivil',
        'ocupacion', 'estudios', 'tipoSangre'
    ];    
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente'); // FK de esta tabla
    }
}
