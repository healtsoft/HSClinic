<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_consultas', function (Blueprint $table) {
            $table->id();
            $table->text('motivoConsulta')->nullable();
            $table->text('causaMolestia')->nullable();
            $table->text('inicioMolestia')->nullable();
            $table->text('ttoPrevio')->nullable();
            $table->text('causaAumento')->nullable();
            $table->text('causaDisminuye')->nullable();
            $table->text('nivelDolor')->nullable();
            $table->text('alteracionesMarcha')->nullable();
            $table->text('disposotivoAsistencia')->nullable();
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
        Schema::dropIfExists('datos_consultas');
    }
}
