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
            $table->integer('pool_id')->unsigned()->nullable();
            $table->foreign('pool_id')->references('id')->on('pools')->onDelete('set null');
            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->integer('presentation_id')->unsigned();
            $table->foreign('presentation_id')->references('id')->on('presentation_resources')->onDelete('no action');
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
        Schema::table('pools_resources_used', function(Blueprint $table){
            $table->dropForeign('pools_resources_used_resource_id_foreign');
            $table->dropColumn('resource_id');
        });
        Schema::dropIfExists('pools_resources_used');
    }
}
