<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'work',
        'title',
        'start',
        'end',
        'type',
        'created_at',
        'check_event'
    ];
}
