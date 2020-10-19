<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_ttos', function (Blueprint $table) {
            $table->id();
            $table->text('dxMedico')->nullable();
            $table->text('dxFisio')->nullable();
            $table->text('codigoCie')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('objetivoTto')->nullable();
            $table->text('comentarios')->nullable();
            $table->integer('numeroSesiones')->nullable();
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
        Schema::dropIfExists('datos_ttos');
    }
}
