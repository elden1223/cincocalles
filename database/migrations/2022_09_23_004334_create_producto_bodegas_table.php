<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoBodegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_bodegas', function (Blueprint $table) {
            $table->id();
            $table->string('nro_lote')->nullable();
            $table->string('codigo_barra')->nullable();
            $table->double('precio_compra');
            $table->double('precio_venta_base');
            $table->integer('stock');
            $table->date('fecha_vencimiento')->nullable();
            $table->bigInteger('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('producto_bodegas');
    }
}
