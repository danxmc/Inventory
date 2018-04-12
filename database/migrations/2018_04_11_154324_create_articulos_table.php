<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('sku')->unique();
            $table->string('name');
            $table->longText('description');
            $table->integer('stock_min');
            $table->integer('stock_max');
            $table->integer('pto_abastecimiento');
            $table->decimal('price',8, 2);
            $table->integer('risk_level');
            $table->string('category');
            $table->string('unit');
            $table->integer('stock');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
