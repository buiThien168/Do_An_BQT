<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms'; 
    protected $fillable = [
        'room_name',
        'note',
        'created',
        'created_by',
        'updated_at',
        'updater',
        'deleted',
    ];
}