<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 255);
            $table->string('ap_Paterno', 255);
            $table->string('ap_Materno', 255);
            $table->string('rut', 20);
            $table->string('matricula', 20);
            $table->string('correo', 255)->unique();
            $table->unsignedInteger('id_carrera')->notnull();
            $table->foreign('id_carrera')->references('id')->on('carrera');
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
        Schema::drop('estudiante');
    }
}
