<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('dblp_id')->nullable();
            $table->text('title');
            $table->string('venue');
            $table->string('publisher')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('number')->nullable();
            $table->string('pages')->nullable();
            $table->year('year');
            $table->string('type');
            $table->string('key');
            $table->string('doi');
            $table->string('ee');
            $table->string('url');
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
        Schema::dropIfExists('publications');
    }
}
