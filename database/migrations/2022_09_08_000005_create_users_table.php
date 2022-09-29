<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('email')->unique(); 
            $table->string('password');
            $table->boolean('super_admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('empleado_id')->unsigned();
            $table->bigInteger('sucursal_id')->unsigned()->nullable();
            $table->bigInteger('rol_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->foreign('rol_id')->references('id')->on('roles');            
            $table->rememberToken();
            $table->timestamps();
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
