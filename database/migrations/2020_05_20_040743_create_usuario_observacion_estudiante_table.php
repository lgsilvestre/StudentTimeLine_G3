<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioObservacionEstudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_observacion_estudiante', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario')->notnull();
            $table->unsignedBigInteger('id_observacion')->notnull();
            $table->unsignedBigInteger('id_estudiante')->notnull();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_observacion')->references('id')->on('observacion')->onDelete('cascade');
            $table->foreign('id_estudiante')->references('id')->on('estudiante')->onDelete('cascade');
            



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
        Schema::drop('usuario_observacion_estudiante');
    }
}
