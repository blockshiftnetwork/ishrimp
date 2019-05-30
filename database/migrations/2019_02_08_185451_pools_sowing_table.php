<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PoolsSowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pools_sowing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pool_id')->unsigned()->nullable();
            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('cascade');
            $table->integer('planted_larvae')->comment('Quantity of larvaes planted');
            $table->string('larvae_type');
            $table->date('planted_at');
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
        Schema::dropIfExists('pools_sowing');
    }
}
