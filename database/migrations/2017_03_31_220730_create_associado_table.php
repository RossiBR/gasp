<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associado', function (Blueprint $table) {
            // defaul fields
            $table->increments('id');        
           
            // entity data fields
            $table->integer('registro')->unique();
            $table->integer('registro_digito');
            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('uel')->nullable();
            
            //foreing keys
            //$table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('associado');
    }
}
