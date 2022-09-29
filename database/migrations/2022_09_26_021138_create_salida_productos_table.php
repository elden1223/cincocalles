<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_salida');
            $table->date('fecha');
            $table->string('observaciones')->nullable();
            $table->string('personal_cargo')->nullable();
            $table->boolean('procesado');
            $table->bigInteger('sucursal_id')->unsigned();
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
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
        Schema::dropIfExists('salida_productos');
    }
}
