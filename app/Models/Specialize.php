<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialize extends Model
{
    use HasFactory;
    protected $table = 'specializes';

    protected $fillable = [
        'name_specializes',
        'note',
        'created_by',
        'created',
        'updater',
        'updated_at',
        'deleted',
    ];

}
