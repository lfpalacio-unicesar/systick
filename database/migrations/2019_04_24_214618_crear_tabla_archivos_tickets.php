<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaArchivosTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_archivos', function (Blueprint $table) {

            $table->increments('id')->comment('llave primaria autoincremento');
            $table->string('nombre')->comment('nombre del archivo');
            $table->string('ruta')->comment('ruta del archivo');
            $table->unsignedInteger('ticket_id')->comment('llave foranea tabla tickets');
            
            $table->foreign('ticket_id')->references('id')->on('tickets');

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
        Schema::dropIfExists('archivos_tickets');
    }
}
