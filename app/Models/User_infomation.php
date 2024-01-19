<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_infomation extends Model
{
    use HasFactory;
    protected $table = 'user_infomations';
    protected $fillable = [
        'user_id',
        'full_name',
        'nick_name',
        'email',
        'sex',
        'date_of_birth',
        'place_of_birth',
        'marital_status',
        'id_number',
        'date_range',
        'passport_issuer',
        'hometown',
        'nationality',
        'nation',
        'religion',
        'permanent_residence',
        'staying',
        'image',
        'employee_type',
        'level',
        'specializes',
        'rooms',
        'positions',
        'status',
        'is_deleted',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
