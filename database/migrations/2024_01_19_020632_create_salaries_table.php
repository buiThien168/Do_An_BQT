<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('basic_salary')->nullable();
            $table->bigInteger('perk_salary')->nullable();
            $table->bigInteger('insuranc_salary')->nullable();
            $table->bigInteger('created')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
            $table->bigInteger('updater')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
