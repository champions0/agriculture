<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFastQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fast_questions', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category');
            $table->string('address');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->boolean('is_not_anonymous')->default(1);
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
        Schema::dropIfExists('fast_questions');
    }
}
