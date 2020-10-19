<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosEspecialistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_especialistas', function (Blueprint $table) {
            $table->id();
            $table->text('fotoUrl')->nullable();
            $table->text('domicilio')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->text('suscripcion');
            $table->date('expiracion');
            $table->foreignId('idEspecialista')->references('id')->on('users')->comment('Especialista al que pertenecen los datos');
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
        Schema::dropIfExists('datos_especialistas');
    }
}
