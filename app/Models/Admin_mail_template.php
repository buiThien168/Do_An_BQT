<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_mail_template extends Model
{
    use HasFactory;
    protected $table = 'admin_mail_templates';
    protected $fillable = [
        'template_title',
        'template_content',
        'total_send',
        'is_deleted',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'show_order',
    ];
}
