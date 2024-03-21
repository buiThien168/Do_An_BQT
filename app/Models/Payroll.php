<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payroll';
    protected $fillable = [
        'user_id',
        'month',
        'working_hour',
        'created',
        'created_by',
        'updater',
        'deleted',
    ];
}
