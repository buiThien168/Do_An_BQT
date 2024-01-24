<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_propress extends Model
{
    use HasFactory;
    protected $table = 'work_propresses';
    protected $fillable = [
        'user_id',
        'works',
        'content',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
