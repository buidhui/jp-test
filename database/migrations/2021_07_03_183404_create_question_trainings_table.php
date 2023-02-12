<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('level')->nullable();
            $table->unsignedInteger('cate_test_id')->nullable();
            $table->text('name')->nullable();
            $table->text('answera')->nullable();
            $table->text('answerb')->nullable();
            $table->text('answerc')->nullable();
            $table->text('answerd')->nullable();
            $table->text('answer_true');
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
        Schema::dropIfExists('question_trainings');
    }
}
