<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('language_id');
            $table->primary(['post_id', 'language_id']);
            $table->string('title');
            $table->string('description');
            $table->string('content');
        });

        Schema::table('post_translations', function($table) {
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_translations', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['language_id']);
        });
        Schema::dropIfExists('post_translations');
    }
}
