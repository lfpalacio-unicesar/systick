<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaOficinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinas', function (Blueprint $table) {
            
            $table->increments('id')->comment('llave principal autoincremento tabla oficinas');
            $table->string('nombre')->unique()->comment('nombre de la oficina')->collation('utf8_spanish_ci');
            $table->boolean('tipo')->comment('tipo oficina 0:Subdirección; 1:Coordinación');
            
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
        Schema::dropIfExists('oficinas');
    }
}
