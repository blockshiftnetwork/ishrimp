<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DailyParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pool_id')->unsigned();
            $table->foreign('pool_id')->references('id')->on('pools');
            $table->integer('laboratory_id')->unsigned();
            $table->foreign('laboratory_id')->references('id')->on('laboratories');
            $table->integer('ph')->comment('Acidez entre 7.5-8.5');
            $table->integer('ppt')->comment('Salinidad 15-25');
            $table->integer('ppm')->comment('Do >3.0');
            $table->integer('temperature')->comment('');
            $table->integer('co3')->comment('');
            $table->integer('hco3')->comment('');
            $table->integer('ppm_d')->comment('Dureza 300');
            $table->integer('ppm_a')->comment('Amoniaco nh4+ <1.0');
            $table->integer('ppm_h')->comment('Hierro <1.0');
            $table->integer('green_colonies')->comment('');
            $table->integer('yellow_colonies')->comment('');
            $table->date('date');
            $table->dateTime('hour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_parameters');
    }
}
