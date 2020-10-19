<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDolorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dolors', function (Blueprint $table) {
            $table->id();
            $table->text('nivelDolor');
            $table->foreignId('idPaciente')->references('id')->on('pacientes')->comment('Id del paciente a quien pertenece la nota');
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
        Schema::dropIfExists('dolors');
    }
}
