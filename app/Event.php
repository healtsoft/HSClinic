<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'color', 'textColor',
        'rendering', 'start', 'end', 'estatus'
    ];

    public function terapeuta()
    {
        return $this->belongsTo(User::class, 'idEspecialista'); // FK de esta tabla
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente'); // FK de esta tabla
    }
}