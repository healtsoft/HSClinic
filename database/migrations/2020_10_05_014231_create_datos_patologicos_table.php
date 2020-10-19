<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPatologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_patologicos', function (Blueprint $table) {
            $table->id();
            $table->text('enfermedades')->nullable();
            $table->text('heredofamiliares')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('cirugias')->nullable();
            $table->text('tipoBandera')->nullable();
            $table->text('alcohol')->nullable();
            $table->text('cigarro')->nullable();
            $table->text('drogas')->nullable();
            $table->text('fracturas')->nullable();
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
        Schema::dropIfExists('datos_patologicos');
    }
}
