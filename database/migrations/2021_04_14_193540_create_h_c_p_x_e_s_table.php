<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHCPXESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_c_p_x_e_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPaciente')->references('id')->on('pacientes');
            $table->foreignId('idEspecialista')->references('id')->on('users');
            $table->foreignId('idHC')->references('id')->on('h_clinicas');
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
        Schema::dropIfExists('h_c_p_x_e_s');
    }
}
