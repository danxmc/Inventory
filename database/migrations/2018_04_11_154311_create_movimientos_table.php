<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('type');
            $table->integer('proveedor_RFC')->unsigned()->index()->nullable();
            $table->foreign('proveedor_RFC')->references('rfc')->on('proveedors');

            $table->integer('user_RFC')->unsigned()->index()->nullable();
            $table->foreign('user_RFC')->references('rfc')->on('usuarios');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
