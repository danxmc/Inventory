<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            
            $table->integer('departamento_id')->unsigned()->index()->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos');

            $table->char('mngr_RFC', 9)->unsigned()->index()->nullable();
            $table->foreign('mngr_RFC')->references('rfc')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
