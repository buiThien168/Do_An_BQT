<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_mail_campaign_detail extends Model
{
    use HasFactory;
    protected $table = 'admin_mail_campaign_details';
    protected $fillable = [
        'admin_template_id',
        'admin_mail_config_id',
        'user_id',
        'user_email',
        'receipt_status',
        'receipt_time',
        'created_at',
        'created_by',
    ];
}
