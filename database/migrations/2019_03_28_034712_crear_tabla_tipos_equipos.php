<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTiposEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiposEquipos', function (Blueprint $table) {
            
            $table->increments('id')->comment('llave principal tabla tipos de equipos');
            $table->string('nombre')->unique()->comment('tipos de equipos');
            
            $table->timestamps();            

            $table->engine='InnoDB';
            $table->charset='utf8';
            $table->collation='utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiposEquipos');
    }
}
