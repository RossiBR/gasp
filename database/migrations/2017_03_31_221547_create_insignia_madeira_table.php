<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsigniaMadeiraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insignia_madeira', function (Blueprint $table) {
            $table->increments('id');

            //foreing keys
            $table->integer('associado_id')->unsigned();
            $table->foreign('associado_id')->references('id')->on('associado');
       
            $table->integer('linha_formacao_id')->unsigned();
            $table->foreign('linha_formacao_id')->references('id')->on('linha_formacao');

            $table->integer('ramo_id')->unsigned()->nullable();
            $table->foreign('ramo_id')->references('id')->on('ramo');
            
            $table->integer('ano')->nullable();

            $table->timestamp('data_certificado')->nullable();

            $table->timestamps();

            $table->unique(['associado_id','linha_formacao_id', 'ramo_id']);

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
        Schema::dropIfExists('insignia_madeira');
    }
}
