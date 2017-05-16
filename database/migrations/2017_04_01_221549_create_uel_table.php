<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uel', function (Blueprint $table) {
            $table->increments('id');

            $table->string('regiao');
            $table->integer('numeral')->unique();

            $table->string('nome')->unique();
            
            $table->string('sigla')->nullable();
                   
            $table->timestamp('data_fundacao')->nullable();

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
        Schema::dropIfExists('uel');
    }
}