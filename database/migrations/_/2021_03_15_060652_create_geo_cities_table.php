<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('code');
            $table->integer('sort');
            $table->integer('geobase_id')->nullable();
            $table->integer('geobase_xml_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('federal_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('title_ru');
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
        Schema::dropIfExists('geo_cities');
    }
}
