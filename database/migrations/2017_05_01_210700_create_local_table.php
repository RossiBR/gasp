<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local', function (Blueprint $table) {
            $table->increments('id');
            
            //foreing keys
            $table->string('nome')->unique();
            $table->string('sigla')->unique();       
            $table->string('descricao')->nullable();

            $table->integer('capacidade_pessoas')->nullable();
            $table->integer('permite_pernoite_acampado')->nullable();
            $table->integer('permite_pernoite_acantonado')->nullable();
            
            $table->string('endereco')->nullable();
            $table->string('contato')->nullable();

            $table->string('url_maps')->nullable();

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
        Schema::dropIfExists('local');
    }
}
