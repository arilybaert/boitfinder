<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');

            // location
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();

            // contact
            $table->string('website')->nullable();
            $table->string('telephone')->nullable();

            $table->string('description')->nullable();
            $table->string('coverphoto')->nullable();

            // event specific
            $table->integer('capacity')->nullable();

            // band specific
            $table->string('genre_description')->nullable();
            $table->string('rider')->nullable();

            $table->foreignId('pa_id')->references('id')->on('pa');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
