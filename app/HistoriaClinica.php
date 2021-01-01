<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    // Obtiene la información del usuario via FK
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente'); // FK de esta tabla
    }

    public function dolor()
    {
        return $this->hasMany(Dolor::class, 'idPaciente'); // FK de esta tabla
    }

    public function datosPatologicos()
    {
        return $this->hasOne(DatosPatologico::class, 'idPatologicos'); // FK de esta tabla
    }

    public function datosConsulta()
    {
        return $this->hasOne(DatosConsulta::class, 'idConsulta'); // FK de esta tabla
    }

    public function datosTto()
    {
        return $this->hasOne(datosTto::class, 'idTto'); // FK de esta tabla
    }

    public function estudios()
    {
        return $this->hasMany(Estudio::class); // FK de esta tabla
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
