<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_track extends Model
{
    use HasFactory;
    protected $table = 'user_tracks';
    protected $fillable = [
        'user_id',
        'type',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
