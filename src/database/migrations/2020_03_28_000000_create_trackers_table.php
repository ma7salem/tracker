<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address')->index();
            $table->string('country_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            $table->string('currency')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->timestamps();
        });

        Schema::create('tracker_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tracker_id')->unsigned();
            $table->foreign('tracker_id')->references('id')->on('trackers')->onDelete('cascade');
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('platform')->nullable();
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
        Schema::dropIfExists('tracker_details');
        Schema::dropIfExists('trackers');
    }
}
