<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplineRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discipline_rewards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('value')->nullable();
            $table->bigInteger('type')->nullable();
            $table->bigInteger('created')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_at')->nullable();
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
        Schema::dropIfExists('discipline_rewards');
    }
}
