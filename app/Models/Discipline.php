<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;
    protected $table = 'disciplines';
    protected $fillable = [
        'user_id',
        'note',
        'value',
        'created',
        'created_by',
        'updated_at',
        'updater',
        'deleted',
    ];
}
