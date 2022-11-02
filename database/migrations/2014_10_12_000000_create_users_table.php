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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('surname')->nullable();
            $table->string('number', 500);
            $table->string('soc_number', 500)->nullable();
            $table->string('passport')->nullable();
            $table->string('email')->unique();
            $table->string('country_code');
            $table->string('phone');
            $table->string('region')->nullable();
            $table->string('address');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('sms_verified_at')->nullable();
            $table->date('birth_date');
            $table->string('status')->default(1);
            $table->string('password');
            $table->string('role')->default('citizen');
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
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
