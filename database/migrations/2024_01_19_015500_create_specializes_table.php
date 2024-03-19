<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecializesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specializes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_specializes')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('created')->nullable();
            $table->bigInteger('updater')->nullable();
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
        Schema::dropIfExists('specializes');
    }
}
