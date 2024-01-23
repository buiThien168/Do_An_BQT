<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_type extends Model
{
    use HasFactory;
    protected $table = 'employee_types';
    protected $fillable = [
        'name',
        'note',
        'created',
        'created_by',
        'updated_at',
        'updater',
        'deleted',
    ];
}
