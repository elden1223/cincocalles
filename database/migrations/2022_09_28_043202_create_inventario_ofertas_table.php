<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_ofertas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inventario_id')->unsigned();
            $table->bigInteger('oferta_id')->unsigned();
            $table->foreign('inventario_id')->references('id')->on('inventarios');
            $table->foreign('oferta_id')->references('id')->on('ofertas');
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
        Schema::dropIfExists('inventario_ofertas');
    }
}
