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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('body');
            $table->uuid('user_id');
            $table->integer('reply_id')->nullable();
            $table->integer('retweets_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->unsignedInteger('view_counts')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('collection_id')->default(NULL);
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->boolean('visible')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
};
