<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $table = 'works';
    protected $fillable = [
        'user_id',
        'work_name',
        'note',
        'from',
        'to',
        'status',
        'created',
        'created_by',
        'updated_at',
        'updater',
        'deleted',
    ];
}
