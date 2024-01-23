<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salary';
    protected $fillable = [
        'user_id',
        'hourly_salary',
        'created',
        'created_by',
        'updated_at',
        'updater',
    ];
}
