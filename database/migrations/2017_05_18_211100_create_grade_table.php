<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');

            $table->string('sigla');

            $table->string('qualificacao_diretor')->nullable();

            $table->integer('versao')->unsigned();

            $table->integer('tipo_curso_id')->unsigned()->nullable();
            $table->foreign('tipo_curso_id')->references('id')->on('tipo_curso');

            $table->integer('linha_formacao_id')->unsigned()->nullable();
            $table->foreign('linha_formacao_id')->references('id')->on('linha_formacao');

            $table->integer('ramo_id')->unsigned()->nullable();
            $table->foreign('ramo_id')->references('id')->on('ramo');
            
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
        Schema::dropIfExists('grade');
    }
}
