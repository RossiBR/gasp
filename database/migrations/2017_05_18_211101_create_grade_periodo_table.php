<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradePeriodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_periodo', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('grade_id')->unsigned()->nullable();
            $table->foreign('grade_id')->references('id')->on('grade');

            $table->integer('ordem')->unsigned();                                    
            $table->timestamp('hora_inicio')->nullable();
            $table->timestamp('hora_fim')->nullable();   

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
        Schema::dropIfExists('grade_periodo');
    }
}
