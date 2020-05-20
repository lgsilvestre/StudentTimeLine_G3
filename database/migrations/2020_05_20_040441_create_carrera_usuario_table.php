<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_usuario', function (Blueprint $table) {

            $table->unsignedInteger('id_carrera')->notnull();
            $table->unsignedBigInteger('id_usuario')->notnull();
            $table->foreign('id_carrera')->references('id')->on('carrera'); 
            $table->foreign('id_usuario')->references('id')->on('users');   

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carrera_usuario');
        
    }
}
