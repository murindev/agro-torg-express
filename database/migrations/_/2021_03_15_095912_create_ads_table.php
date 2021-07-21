<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adds_id')->unique();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('category')->nullable();
            $table->string('type')->nullable();
            $table->string('region')->nullable();
            $table->integer('geo_list_value')->nullable();
            $table->string('datetime')->nullable();
            $table->string('comments_cnt')->nullable();
            $table->string('user_code')->nullable();
            $table->string('description')->nullable();
            $table->string('price')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('viewed')->nullable();
            $table->integer('parsed');
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
        Schema::dropIfExists('ads');
    }
}
