<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectionsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projections_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pool_id')->unsigned()->nullable();
            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');
            $table->integer('parameter');
            $table->float('theoretical')->nullable();
            $table->float('real')->nullable();
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
        Schema::dropIfExists('projections_data');
    }
}
