<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_clinicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPaciente')->references('id')->on('pacientes')->comment('Paciente dueño de la historia');
            $table->foreignId('idPatologicos')->references('id')->on('datos_patologicos')->comment('Datos patologicos del paciente');
            $table->foreignId('idConsulta')->references('id')->on('datos_consultas')->comment('Datos de consulta del paciente');
            $table->foreignId('idTto')->references('id')->on('datos_ttos')->comment('Datos del tratamiento a seguir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historia_clinicas');
    }
    
}
