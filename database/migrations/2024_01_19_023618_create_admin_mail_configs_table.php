<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMailConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_mail_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mail_drive')->nullable();
            $table->char('mail_host', 50)->nullable();
            $table->bigInteger('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->char('mail_encryption', 50)->nullable();
            $table->bigInteger('total_send')->default(0);
            $table->bigInteger('is_deleted')->default(0);
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_at')->nullable();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_mail_config');
    }
}
