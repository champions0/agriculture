<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('wallpaper')->nullable();
            $table->string('short_description', 1500)->nullable();
            $table->string('age', 20)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('organizer')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('address', 255);
            $table->string('additional_info', 255)->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('events');
    }
}
