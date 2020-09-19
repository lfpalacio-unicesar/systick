<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTicketsRespuestasArchivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_respuestas_archivos', function (Blueprint $table) {

            $table->increments('id')->comment('llave principal autoincremento');
            $table->string('nombre')->comment('nombre de archivo')->collation('utf8_spanish_ci');
            $table->string('ruta')->comment('ruta_archivo')->collation('utf8_spanish_ci');
            $table->unsignedInteger('respuesta_id')->comment('llave foranea tabla respuestas');

            $table->foreign('respuesta_id')->references('id')->on('tickets_respuestas');            
            
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets_respuestas_archivos');
    }
}
