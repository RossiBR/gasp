<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoVoluntarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_voluntario', function (Blueprint $table) {
            $table->increments('id');

            //foreing keys
            $table->integer('associado_id')->unsigned();
            $table->foreign('associado_id')->references('id')->on('associado');                

            $table->timestamp('data_inicio')->nullable();
            $table->timestamp('data_fim')->nullable();

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
        Schema::dropIfExists('contrato_voluntario');
    }
}
