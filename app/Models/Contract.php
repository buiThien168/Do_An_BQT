<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';
    protected $fillable = [
        'name_contract',
        'user_id',
        'contract_type',
        'contract_number',
        'signing_date',
        'start_date',
        'start_end',
        'name_A',
        'birth_A',
        'phone_number_A',
        'email_A',
        'name_B',
        'birth_B',
        'phone_number_B',
        'email_B',
        'positions',
        'basic_salary',
        'employee_type',
        'educationals',
        'note',
    ];
}