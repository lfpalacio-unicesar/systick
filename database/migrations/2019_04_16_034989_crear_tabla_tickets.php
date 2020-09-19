<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {

            $table->increments('id')->comment('llave principal tabla tickets');
            $table->unsignedInteger('servicio_id')->comment('llave foranea tabla servicios');            
            $table->unsignedInteger('user_id')->comment('llave foranea a tabla usuarios');
            $table->unsignedInteger('estado_id')->default(1)->comment('llave foranea a tabla estados tickets');           
            $table->string('titular')->comment('nombre del titular del ticket');
            $table->string('asunto')->comment('asunto o título ticket');
            $table->text('descripcion')->comment('descripción del ticket');
            $table->unsignedInteger('equipo_id')->nullable()->comment('almacena id del equipo asociado para los tickets de tipo tecnico');
            $table->unsignedInteger('asignado')->nullable()->comment('id del usuario que tiene asignado el ticket');
            
            $table->foreign('estado_id')->references('id')->on('tickets_estados');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('asignado')->references('id')->on('users'); 

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
        Schema::dropIfExists('tickets');
    }
}
