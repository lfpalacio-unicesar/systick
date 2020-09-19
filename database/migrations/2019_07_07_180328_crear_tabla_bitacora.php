<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBitacora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->increments('id')->comment('llave principal autoincremento');
            $table->unsignedInteger('usuario_id')->comment('llave foranea tabal usuarios');
            $table->text('accion')->comment('detalle de la acción realizada')->collation('utf8_spanish_ci');            
            $table->string('ip')->comment('dirección ip del pc donde se realiza la acción')->collation('utf8_spanish_ci');

            $table->foreign('usuario_id')->references('id')->on('users');

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
        Schema::dropIfExists('bitacora');
    }
}
