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
        Schema::create('formador', function (Blueprint $table) {
            $table->increments('id');

            //foreing keys
            $table->integer('associado_id')->unsigned();
            $table->foreign('associado_id')->references('id')->on('associado');                

            $table->timestamp('seminario')->nullable();
            $table->timestamp('seminario_ano')->nullable();
            $table->timestamp('seminario_data_certificado')->nullable();

            $table->timestamp('cf1')->nullable();
            $table->timestamp('cf1_ano')->nullable();
            $table->timestamp('cf1_data_certificado')->nullable();

            $table->timestamp('cf2')->nullable();
            $table->timestamp('scf2_ano')->nullable();
            $table->timestamp('cf2_data_certificado')->nullable();

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
