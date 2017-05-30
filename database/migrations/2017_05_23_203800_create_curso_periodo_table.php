<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoPeriodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_periodo', function (Blueprint $table) {
            $table->increments('id');
            
            //foreing keys
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('curso');

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
        Schema::dropIfExists('curso_periodo');
    }
}
