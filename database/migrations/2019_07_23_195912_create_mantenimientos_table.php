<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {

            // campos de mantenimiento
            $table->increments('id')->comment('Llave principal autoincremento');
            $table->unsignedInteger('tipo')->comment('tipo mantenimiento 1:Preventivo; 2:Correctivo');
            $table->text('estado')->nullable()->comment('estado en que se recibe un equipo');
            $table->text('acciones')->nullable()->comment('acciones tomadas sobre el equipo en el antenimiento');
            $table->text('conclusiones')->nullable()->comment('conclusiones del mantenimiento');
            $table->unsignedInteger('equipo_id')->comment('llave foranea tabla equipo');
            $table->date('fingreso')->comment('fecha de ingreso del equipo a mantenimiento');
            $table->date('fprogramada')->nullable()->comment('fecha programada de mantenimiento del equipo');
            $table->date('fentrega')->nullable()->comment('fecha entrega de equipo');
            $table->unsignedInteger('responsable')->comment('Llave foranea tabla usuarios, responsable del mantenimiento');

            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('responsable')->references('id')->on('users');
            $table->foreign('tipo')->references('id')->on('tipos_mantenimientos');
            
            // campos de equipos
            $table->unsignedInteger('tipo_id')->comment('llave foranea tabla tipo');
            $table->boolean('critico')->comment('clasifica si el equipo es critico 0:no y 1:si');
            $table->unsignedInteger('oficina_id')->comment('llave foranea oficina donde se ubica el equipo')->collation('utf8_spanish_ci');
            $table->unsignedInteger('marca_id')->comment('llave foranea tabla marcas');
            $table->string('modelo')->comment('modelo del equipo')->collation('utf8_spanish_ci');
            $table->string('sticker')->comment('sticker interno')->collation('utf8_spanish_ci');
            $table->string('sticker_monitor')->nullable()->comment('sticker monitor')->collation('utf8_spanish_ci');
            $table->string('sticker_teclado')->nullable()->comment('sticker teclado')->collation('utf8_spanish_ci');
            $table->string('sticker_mouse')->nullable()->comment('sticker mouse')->collation('utf8_spanish_ci');
            $table->string('procesador')->nullable($value=true)->comment('referencia procesador equipo')->collation('utf8_spanish_ci');
            $table->string('ram')->nullable($value=true)->comment('capacidad memoria principal')->collation('utf8_spanish_ci');
            $table->string('almacenamiento')->nullable($value=true)->comment('capacidad de almacenamiento equipo')->collation('utf8_spanish_ci');
            $table->unsignedInteger('sistema_id')->comment('llave foranea tabla sistemas');
            $table->tinyInteger('estadoSistema')->comment('estado licencia del sistema 0:No, 1:Si, 2:No requiere');            
            $table->unsignedInteger('suite_id')->comment('llave foranea tabla suites');
            $table->tinyInteger('estadoSuite')->comment('estado licencia suite ofimarica 0:No, 1:Si, 2:No requiere');
            $table->unsignedInteger('antivirus_id')->comment('llave foranea tabla antivirus');
            $table->tinyInteger('estadoAntivirus')->comment('estado licencia antivirus 0:No, 1:Si, 2:No requiere');
            $table->date('fcompra')->comment('fecha de compra equipo');
            $table->date('finstalacion')->nullable()->comment('fecha de instalacion equipo');
            $table->date('fbaja')->nullable()->comment('fecha de baja equipo');
            $table->tinyInteger('estado_equipo')->default(1)->comment('estado del equipo 0:Inactivo; 1:Activo');
            $table->text('motivo_baja')->nullable()->comment('se argumenta el motivo por el cual se descarta un equipo');
            
            $table->string('nombre')->nullable()->comment('nombre de equipo en el sistema operativo')->collation('utf8_spanish_ci');
            $table->string('ip')->nullable()->comment('direccion IP del equipo')->collation('utf8_spanish_ci');
            $table->string('mac')->nullable()->comment('direccion MAC de lal tarjeta de red del equipo')->collation('utf8_spanish_ci');
            $table->string('asignado')->nullable()->comment('nombre persona que tiene el equipo asignado')->collation('utf8_spanish_ci');
            $table->unsignedInteger('usuario_id')->comment('llave foranea tabla usuarios | responsable de equipo');            

            $table->foreign('oficina_id')->references('id')->on('oficinas');
            $table->foreign('tipo_id')->references('id')->on('tiposEquipos');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('sistema_id')->references('id')->on('sistemas');
            $table->foreign('suite_id')->references('id')->on('suite');
            $table->foreign('antivirus_id')->references('id')->on('antivirus');
            $table->foreign('usuario_id')->references('id')->on('users');            

            //fin campos de equipos

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
        Schema::dropIfExists('mantenimientos');
    }
}
