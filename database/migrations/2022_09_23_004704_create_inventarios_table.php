<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('producto_bodega_id')->unsigned();            
            $table->double('precio_venta');
            $table->integer('stock');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
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
        Schema::dropIfExists('inventarios');
    }
}
