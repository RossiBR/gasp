<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->increments('id');
            
            //foreing keys
            $table->integer('grade_id')->unsigned()->nullable();
            $table->foreign('grade_id')->references('id')->on('grade');
            
            $table->integer('local_id')->unsigned()->nullable();
            $table->foreign('local_id')->references('id')->on('local');

            $table->integer('distrito_id')->unsigned()->nullable();
            $table->foreign('distrito_id')->references('id')->on('distrito');

            $table->integer('diretor_associado_id')->unsigned()->nullable();
            $table->foreign('diretor_associado_id')->references('id')->on('associado');

            $table->integer('criador_id')->unsigned();
            $table->foreign('criador_id')->references('id')->on('users');     

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
        Schema::dropIfExists('curso');
    }
}
