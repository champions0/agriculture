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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('number', 500)->nullable();
            $table->string('soc_number', 500)->nullable();
            $table->string('passport')->nullable();
            $table->string('email')->unique();
            $table->string('country_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('sms_verified_at')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('status')->default(1);
            $table->string('password')->nullable();
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
