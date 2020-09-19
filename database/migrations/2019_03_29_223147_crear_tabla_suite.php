<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSuite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suite', function (Blueprint $table) {

            $table->increments('id')->comment('llave principal autoincremento');
            $table->string('nombre')->unique()->comment('nombre suite ofimatica');
            
            $table->timestamps();            

            $table->engine ='InnoDB';
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
        Schema::dropIfExists('suite');
    }
}
