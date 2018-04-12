<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_movimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('cantidad');

            $table->integer('movimiento_id')->unsigned()->index()->nullable();
            $table->foreign('movimiento_id')->references('id')->on('movimientos')->onDelete('cascade');;

            $table->integer('articulo_sku')->unsigned()->index()->nullable();
            $table->foreign('articulo_sku')->references('sku')->on('articulos')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo_movimientos');
    }
}
