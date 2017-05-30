<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoEquipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_equipe', function (Blueprint $table) {
            $table->increments('id');
            
            //foreing keys
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('curso');

            $table->integer('associado_id')->unsigned();
            $table->foreign('associado_id')->references('id')->on('associado');

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
        Schema::dropIfExists('curso_equipe');
    }
}
