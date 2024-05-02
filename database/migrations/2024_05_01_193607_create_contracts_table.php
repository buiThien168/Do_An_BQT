<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_contract')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('contract_type')->nullable();
            $table->string('contract_number')->nullable();
            $table->bigInteger('signing_date')->nullable();
            $table->bigInteger('start_date')->nullable();
            $table->bigInteger('start_end')->nullable();
            $table->string('name_A')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('phone_number_A')->nullable();
            $table->string('address_A')->nullable();
            $table->string('name_B')->nullable();
            $table->bigInteger('birth_B')->nullable();
            $table->string('phone_number_B')->nullable();
            $table->string('address_B')->nullable();
            $table->string('CCCD_B')->nullable();
            $table->bigInteger('positions')->nullable();
            $table->bigInteger('basic_salary')->nullable();
            $table->bigInteger('employee_type')->nullable();
            $table->bigInteger('educationals')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
