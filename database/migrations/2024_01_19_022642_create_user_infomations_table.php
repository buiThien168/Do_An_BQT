<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfomationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infomations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('sex')->nullable();
            $table->bigInteger('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->bigInteger('marital_status')->nullable();
            $table->bigInteger('id_number')->nullable();
            $table->bigInteger('date_range')->nullable();
            $table->string('passport_issuer')->nullable();
            $table->string('hometown')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nation')->nullable();
            $table->string('religion')->nullable();
            $table->string('permanent_residence')->nullable();
            $table->string('staying')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('employee_type')->nullable();
            $table->bigInteger('level')->nullable();
            $table->bigInteger('specializes')->nullable();
            $table->bigInteger('rooms')->nullable();
            $table->bigInteger('positions')->nullable();
            $table->bigInteger('status')->nullable();
            $table->bigInteger('is_deleted')->default(0);
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
        Schema::dropIfExists('user_infomations');
    }
}
