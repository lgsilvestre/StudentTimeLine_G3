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
            $table->string('sexo', 255)->notnull();
            $table->string('fech_nac')->notnull();
            $table->integer('plan')->unsigned()->default(16);
            $table->integer('año_ingreso')->unsigned()->default(2020);
            $table->string('estado_actual',255)->default('regular');
            $table->string('comuna',255)->notnull()->default('curico');
            $table->integer('region')->unsigned()->default(7);
            $table->integer('creditos_aprobados')->notnull();
            $table->integer('nivel')->notnull();
            $table->integer('porc_avance')->notnull();
            $table->string('ult_ptje_prioridad')->notnull();
            $table->string('regular')->notnull();
            $table->string('prom_aprobadas')->notnull();
            $table->string('prom_cursados')->notnull();
            $table->unsignedInteger('id_carrera')->notnull();
            $table->foreign('id_carrera')->references('id')->on('carrera');
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
