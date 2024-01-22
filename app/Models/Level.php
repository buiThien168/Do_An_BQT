<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $table = 'levels';
    protected $fillable = [
        'qualification_name',
        'note',
        'created',
        'created_by',
        'updated_at',
        'updater',
        'deleted',
    ];

}
