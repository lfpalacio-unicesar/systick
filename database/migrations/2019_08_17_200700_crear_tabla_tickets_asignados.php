<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTicketsAsignados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_asignados', function (Blueprint $table) {
            
            $table->increments('id')->comment('llave principa autoincremento');
            $table->unsignedInteger('ticket_id')->comment('llave foranea tabla tickets');
            $table->unsignedInteger('user_id')->comment('llave foranea tabla usuarios');
            
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('tickets_asignados');
    }
}
