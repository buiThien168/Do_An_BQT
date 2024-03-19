<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_position')->nullable();
            $table->string('note')->nullable();
            $table->bigInteger('luong_ngay')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('created')->nullable();
            $table->timestamps();
            $table->bigInteger('updater')->nullable();
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
        Schema::dropIfExists('positions');
    }
}
