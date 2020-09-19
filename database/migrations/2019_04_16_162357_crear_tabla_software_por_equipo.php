<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSoftwarePorEquipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_equipo', function (Blueprint $table) {

            $table->increments('id')->comment('llave principal autoincremento');
            $table->unsignedInteger('equipo_id')->comment('llave foranea tabla equipos');
            $table->unsignedInteger('software_id')->comment('llave foranea tabla software');

            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('software_id')->references('id')->on('softwares');
            
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
        Schema::dropIfExists('software_equipo');
    }
}
