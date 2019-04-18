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
            $table->float('ph',3,1)->comment('Acidez entre 7.5-8.5');
            $table->float('ppt',4,2)->comment('Salinidad 15-25');
            $table->float('ppm',5,4)->comment('Do >3.0');
            $table->float('temperature')->comment('');
            $table->float('co3')->comment('');
            $table->float('hco3')->comment('');
            $table->float('ppm_d')->comment('Dureza 300');
            $table->float('ppm_a',4,3)->comment('Amoniaco nh4+ <1.0');
            $table->float('ppm_h',4,3)->comment('Hierro <0.1');
            $table->float('green_colonies')->comment('');
            $table->float('yellow_colonies')->comment('');
            $table->date('date');
            $table->time('hour');
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
