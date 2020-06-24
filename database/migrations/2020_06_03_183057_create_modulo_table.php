<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('descripcion',255)->notnull();
            $table->unsignedInteger('id_carrera')->notnull();
            $table->foreign('id_carrera')->references('id')->on('carrera')->onDelete('cascade');
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
        Schema::table('modulo', function (Blueprint $table) {
            //
        });
    }
}
