<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class educational extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_education',
        'note',
        'created_by',
        'updated_at',
        'deleted',
    ];
}
