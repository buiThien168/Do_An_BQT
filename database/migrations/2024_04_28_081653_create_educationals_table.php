<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educationals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_education')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
            $table->bigInteger('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educationals');
    }
}
