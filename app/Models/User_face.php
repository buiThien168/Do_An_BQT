<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_face extends Model
{
    use HasFactory;
    protected $table = 'user_faces';

    protected $fillable = [
        'name',
        'image',
        'order_by',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
