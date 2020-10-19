<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_personals', function (Blueprint $table) {
            $table->id();
            $table->text('fotoUrl')->nullable();
            $table->text('domicilio')->nullable();
            $table->text('sexo')->nullable();
            $table->text('estadoCivil')->nullable();
            $table->text('ocupacion')->nullable();
            $table->text('estudios')->nullable();
            $table->text('tipoSangre')->nullable();  
            $table->foreignId('idPaciente')->references('id')->on('pacientes')->comment('Paciente al que pertenecen los datos');
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
        Schema::dropIfExists('datos_personals');
    }
}
