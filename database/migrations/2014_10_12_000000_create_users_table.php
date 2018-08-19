<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_of_birth')->nullable();
            $table->string('country')->nullable();
            $table->char('gender')->nullable();
            $table->string('affiliation');
            $table->string('lines_of_research');
            $table->string('avatar')->default('avatar.jpg');
<<<<<<< HEAD
            $table->string('privacy')->default('public');
            $table->string('dblp_id')->nullable();
=======
            $table->string('dblp_id')->nullable();
            $table->string('privacy')->default('public');
>>>>>>> homepage
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
