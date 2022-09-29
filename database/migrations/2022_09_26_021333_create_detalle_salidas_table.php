<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_salidas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('salida_producto_id')->unsigned();
            $table->bigInteger('producto_bodega_id')->unsigned();
            $table->integer('cantidad');
            $table->foreign('salida_producto_id')->references('id')->on('salida_productos');
            $table->foreign('producto_bodega_id')->references('id')->on('producto_bodegas');
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
        Schema::dropIfExists('detalle_salidas');
    }
}
