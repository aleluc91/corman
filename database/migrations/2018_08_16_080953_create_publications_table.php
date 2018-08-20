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
            $table->string('dblp_id')->nullable();
            $table->text('title')->nullable();
            $table->string('venue')->nullable();
            $table->string('publisher')->nullable();
            $table->string('volume')->nullable();
            $table->string('number')->nullable();
            $table->string('pages')->nullable();
            $table->year('year')->nullable();
            $table->string('type')->nullable();
            $table->string('key')->nullable();
            $table->string('doi')->nullable();
            $table->string('ee')->nullable();
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
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
