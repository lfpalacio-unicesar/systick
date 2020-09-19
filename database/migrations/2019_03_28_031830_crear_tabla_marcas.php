<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMarcas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {

            $table->increments('id')->comment('llave principal tabla marcas');
            $table->string('nombre')->unique()->comment('nombre de la marca');
                        
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
        Schema::dropIfExists('marcas');
    }
}
