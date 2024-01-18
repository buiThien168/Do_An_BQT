<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\Account\AccountController;


require 'admin/admin.php';
require 'staff/staff.php';

 Route::get('/', [AccountController::class, 'Login']);
 Route::post('/', [AccountController::class, 'PostLogin']);