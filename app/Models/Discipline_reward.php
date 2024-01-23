<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline_reward extends Model
{
    use HasFactory;
    protected $table = 'discipline_rewards';
    protected $fillable = [
        'user_id',
        'note',
        'value',
        'type',
        'created',
        'created_by',
        'updated_at',
        'updater',
        'deleted',
    ];
}
