<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('geo_id');
            $table->integer('geo_xml_id');
            $table->string('is');
            $table->integer('cnt');
            $table->integer('geo_city');
            $table->string('country');
            $table->string('federal');
            $table->string('region');
            $table->string('city');
            $table->string('value');
            $table->string('text');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_list');
    }
}
