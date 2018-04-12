<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->char('rfc', 9)->unique();
            $table->string('email');
            $table->string('name');
            $table->bigInteger('phone');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('zip_code');
            $table->string('contact');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
}
