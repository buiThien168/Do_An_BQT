<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_mail_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('template_title', 250)->nullable();
            $table->text('template_content')->nullable();
            $table->bigInteger('total_send')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('show_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_mail_templates');
    }
}
