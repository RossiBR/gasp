<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_modulo', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ordem')->unsigned();

            $table->integer('curso_id')->unsigned()->nullable();
            $table->foreign('curso_id')->references('id')->on('curso');

            $table->integer('modulo_id')->unsigned()->nullable();
            $table->foreign('modulo_id')->references('id')->on('modulo');

            $table->integer('curso_periodo_id')->unsigned()->nullable();
            $table->foreign('curso_periodo_id')->references('id')->on('curso_periodo');
            
            $table->integer('carga_horaria_min');

            $table->timestamps();

            $table->engine = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_modulo');
    }
}
