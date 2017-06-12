<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeModuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_modulo', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ordem')->unsigned();

            $table->integer('grade_id')->unsigned()->nullable();
            $table->foreign('grade_id')->references('id')->on('grade');

            $table->integer('periodo')->unsigned();

            $table->integer('grade_periodo_id')->unsigned()->nullable();
            $table->foreign('grade_periodo_id')->references('id')->on('grade_periodo');

            $table->integer('modulo_id')->unsigned()->nullable();
            $table->foreign('modulo_id')->references('id')->on('modulo');
           
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
        Schema::dropIfExists('grade_modulo');
    }
}
