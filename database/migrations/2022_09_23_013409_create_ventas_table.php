<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nro_venta');
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('tipo_pago_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('fecha');
            $table->double('total');  
            $table->boolean('completado');          
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('tipo_pago_id')->references('id')->on('tipo_pagos');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ventas');
    }
}
