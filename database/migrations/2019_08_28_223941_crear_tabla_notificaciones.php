<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaNotificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('usuario_id')->comment('llave foranea tabla usuarios, se almacena el id de aquien va dirido la notificacion');
            $table->text('mensaje')->collation('utf8_spanish_ci')->comment('mensaje de la notificación');
            $table->tinyInteger('visto')->default(0)->comment('0: no ha sido visto por el usuario; 1: visto por el usuario');
            $table->string('persona')->nullable()->comment('Se almacena el nombre de la persona que acciona la notificacion')->collation('utf8_spanish_ci');
            $table->unsignedInteger('ticket_id')->nullable()->comment('llave foranea tabla tickets');


            $table->foreign('usuario_id')->references('id')->on('users');
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
        Schema::dropIfExists('notificaciones');
    }
}
