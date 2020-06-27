<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 255)->notnull();
            $table->string('tipo_observacion',255)->notnull();
            $table->string('descripcion', 2000)->notnull();
            $table->unsignedBigInteger('id_categoria')->notnull();
            $table->string('nombre_categoria',255)->notnull();
            //$table->foreign('id_categoria')->references('id')->on('categoria')->onDelete('cascade');
            $table->string('modulo', 255)->notnull();
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
        Schema::drop('observacion');
        
    }
}
