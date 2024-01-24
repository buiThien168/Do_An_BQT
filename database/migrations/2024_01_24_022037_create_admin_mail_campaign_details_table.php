<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMailCampaignDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_mail_campaign_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_template_id')->nullable();
            $table->bigInteger('admin_mail_config_id')->nullable();
            $table->bigInteger('user_id');
            $table->string('user_email')->nullable();
            $table->tinyInteger('receipt_status')->default(0);
            $table->bigInteger('receipt_time')->nullable();
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_mail_campaign_details');
    }
}
