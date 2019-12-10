<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('type')->default(1);
            $table->string('square');
            $table->tinyInteger('rent');
            $table->tinyInteger('rooms');
            $table->decimal('price', 5, 2)->default(0);
            $table->string('meta');
            $table->longText('content');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('place');
            $table->tinyInteger('status')->default(1);
            $table->string('image')->default('default.png');
            $table->Integer('user_id')->default(0);
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('buildings');
    }
}
