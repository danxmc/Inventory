<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->char('rfc', 9)->unique();
            $table->string('email');
            $table->string('name');
            $table->string('position');
            $table->bigInteger('phone');
            $table->char('gender',1);
            $table->date('birth_date');

            $table->integer('departamento_id')->unsigned()->index()->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
