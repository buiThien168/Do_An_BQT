<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';
    protected $fillable = [
        'name_position',
        'note',
        'luong_ngay',
        'created_by',
        'created',
        'updated_at',
        'updater',
        'deleted',
    ];
}
