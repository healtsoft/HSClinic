<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

    protected $fillable = [
        'nombre', 'fechaNacimiento', 'correo', 'procedencia', 'seguro', 'telefono'
    ];

    // Obtiene la información del usuario via FK
    public function especialista()
    {
        return $this->belongsTo(User::class, 'idEspecialista'); // FK de esta tabla
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'idPaciente');
    }

    public function estudios()
    {
        return $this->hasMany(Estudio::class, 'idPaciente');
    }

    public function datos_personals()
    {
        return $this->hasMany(DatosPersonal::class, 'idPaciente');
    }

    public function  signosVitales ()
    {
        return $this->hasMany(SignosVital::class, 'idPaciente');
    }

    public function historiaClinica()
    {
        return $this->hasMany(HistoriaClinica::class, 'idPaciente');
    }

    public function eventos()
    {
        return $this->hasMany(Event::class, 'idPaciente');
    }
}
