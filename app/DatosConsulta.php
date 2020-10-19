<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosConsulta extends Model
{
    protected $fillable = [
        'motivoConsulta', 'causaMolestia', 'inicioMolestia', 'ttoPrevio',
        'causaAumento', 'causaDisminuye', 'nivelDolor', 'alteracionesMarcha',
        'disposotivoAsistencia'
    ];

    public function historiaClinica()
    {
        return $this->hasOne(HistoriaClinica::class); // FK de esta tabla
    }
}
