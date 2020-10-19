<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->text('description')->nullable();
            $table->string('color', 20)->nullable();
            $table->string('textColor', 20)->nullable();
            $table->string('rendering', 50)->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->foreignId('idPaciente')->references('id')->on('pacientes')->comment('El paciente que asistira a la cita');
            $table->foreignId('idEspecialista')->references('id')->on('users')->comment('El especialista que atendera la cita');
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
        Schema::dropIfExists('events');
    }
}
