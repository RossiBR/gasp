<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distrito', function (Blueprint $table) {
            $table->increments('id');

            $table->string('regiao');
            $table->integer('numeral')->unique()->nullable();

            $table->string('nome')->unique();
            
            $table->string('sigla')->nullable();
                   
            $table->timestamp('data_fundacao')->nullable();

            $table->boolean('ativo')->nullable();

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
        Schema::dropIfExists('distrito');
    }
}