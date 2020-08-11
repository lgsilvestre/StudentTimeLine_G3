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
            $table->string('matricula', 20);
            $table->string('rut', 20);
            $table->string('nombre', 255);
            $table->string('ap_Paterno', 255);
            $table->string('ap_Materno', 255);
            $table->string('correo', 255)->unique();
            $table->string('via_ingreso', 255)->notnull()->default('PSU');
            $table->string('sexo', 255)->notnull();
            $table->string('fech_nac')->notnull();
            $table->integer('plan')->unsigned()->nullable();
            $table->integer('año_ingreso')->unsigned();
            $table->string('estado_actual',255)->nullable();
            $table->string('comuna',255)->nullable();
            $table->integer('region')->unsigned()->nullable();
            $table->integer('creditos_aprobados')->nullable();
            $table->integer('nivel')->nullable();
            $table->integer('porc_avance')->nullable();
            $table->string('ult_ptje_prioridad')->nullable();
            $table->string('regular')->nullable();
            $table->string('prom_aprobadas')->nullable();
            $table->string('prom_cursados')->nullable();
            $table->unsignedInteger('id_carrera')->notnull();
            $table->foreign('id_carrera')->references('id')->on('carrera')->onDelete('cascade');
            $table->integer('num_observaciones')->unsigned()->default(0);
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
