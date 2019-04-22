<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PoolsResourcesUsedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pools_resources_used', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pool_id')->unsigned();
            $table->foreign('pool_id')->references('id')->on('pools')->nullable();
            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->integer('presentation_id')->unsigned();
            $table->foreign('presentation_id')->references('id')->on('presentation_resources');
            $table->float('quantity', 21, 2);
            $table->string('note')->nullable();
            $table->dateTime('date');
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
        Schema::dropIfExists('pools_resources_used');
    }
}
