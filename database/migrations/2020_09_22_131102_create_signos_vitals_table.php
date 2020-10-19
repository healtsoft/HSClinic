<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignosVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signos_vitals', function (Blueprint $table) {
            $table->id();
            $table->text('temperatura')->nullable();
            $table->text('pulso')->nullable();
            $table->text('frecuenciaRespiratoria')->nullable();
            $table->text('presionSistolica')->nullable();
            $table->text('presionDiastolica')->nullable();
            $table->text('glucosa')->nullable();
            $table->foreignId('idPaciente')->references('id')->on('pacientes')->comment('El paciente a quien pertenecen los signos vitales');
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
        Schema::dropIfExists('signos_vitals');
    }
}
