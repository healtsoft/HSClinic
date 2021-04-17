<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPaciente')->references('id')->on('pacientes');
            $table->foreignId('idEspecialista')->references('id')->on('users');
            $table->foreignId('idHC')->references('id')->on('h_clinicas');
            $table->foreignId('idPregunta')->references('id')->on('preguntas');
            $table->text('respuesta');
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
        Schema::dropIfExists('expedientes');
    }
}
