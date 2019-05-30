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
            $table->integer('pool_id')->unsigned()->nullable();
            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');
            $table->float('weight');
            $table->float('quantity');
            $table->float('abw',6,3)->comment('peso promedio del camaron(g)');
            $table->float('wg',6,3)->comment('diferencia con respecto al average anterior(g)');
            $table->float('survival_percent');
            $table->date('abw_date');
            $table->time('abw_hour');
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
