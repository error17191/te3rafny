<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->unsignedInteger('answered_by_id');
            $table->unsignedInteger('asked_by_id')->index();
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('choice_id');
            $table->timestamps();

            $table->foreign('answered_by_id')->references('id')->on('users');
            $table->foreign('asked_by_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('choice_id')->references('id')->on('choices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
