<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unsigned()->unique();
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('google_id')->nullable();
            $table->string('date_of_birth');
            $table->string('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('user_image_path')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('phone_number')->nullable();
            $table->boolean('phone_verified')->nullable();
            $table->boolean('blue_verified')->nullable();
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
};
