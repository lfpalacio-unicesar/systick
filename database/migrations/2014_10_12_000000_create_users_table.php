<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('llave principal tabla usuario');
            $table->string('name')->comment('nombre personal usuario');
            $table->string('username',50)->unique()->comnent('nombre usuario en sistema');
            $table->string('email')->unique()->comment('correo electronico');
            $table->string('imagen')->default('user.png')->comment('imagen usuario');
            $table->boolean('estado')->comment('estado del usuario 0:Inactivo, 1:Activo');
            $table->unsignedInteger('oficina_id')->comment('llave foranea tabla oficina');
            $table->boolean('rol')->default(0)->comment('0:estandar, 1:admin, 2:Superadmin' );
            $table->string('password')->comment('contraseña usuario');
            
            $table->foreign('oficina_id')->references('id')->on('oficinas');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('users');
    }
}
