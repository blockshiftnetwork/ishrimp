<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DailySamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pool_id')->unsigned();
            $table->foreign('pool_id')->references('id')->on('pools');
            $table->float('weight');
            $table->float('quantity');
            $table->float('agw')->comment('peso promedio del camaron(g)');
            $table->float('wg')->comment('diferencia con respecto al average anterior(g)');
            $table->float('survival_percent');
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
        Schema::dropIfExists('daily_samples');
    }
}
