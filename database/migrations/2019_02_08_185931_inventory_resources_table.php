<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->integer('quantity');
            $table->integer('presentation_id')->unsigned();
            $table->foreign('presentation_id')->references('id')->on('presentation_resources');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
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
        Schema::table('inventory_resources', function(Blueprint $table){
            $table->dropForeign('inventory_resources_resource_id_foreign');
            $table->dropColumn('resource_id');
        });
        Schema::dropIfExists('inventory_resources');
    }
}
