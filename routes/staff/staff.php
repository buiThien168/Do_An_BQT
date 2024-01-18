<?php

use App\Http\Controllers\Staff\Account\AccountController;
use App\Http\Controllers\Staff\Infomation\InfomationController;
use App\Http\Controllers\Staff\ChangePassword\ChangePasswordController;
use App\Http\Controllers\Staff\Face\FaceController;
use App\Http\Controllers\Staff\Work\WorkController;
use App\Http\Controllers\Staff\Bonus\BonusController;
use App\Http\Controllers\Staff\Discipline\DisciplineController;
use App\Http\Controllers\Staff\Salary\SalaryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkuser'], function () {
    Route::prefix('account-information')->group(function () {
        Route::get('/', [InfomationController::class, 'Infomation']); 
        Route::post('/edit', [InfomationController::class, 'PostEditInfomation']);         
    });

    Route::prefix('change-password')->group(function () {
        Route::get('/', [ChangePasswordController::class, 'ChangePassword']); 
        Route::post('/', [ChangePasswordController::class, 'PostChangePassword']);         
    });

    Route::prefix('workflow-management')->group(function () {
        Route::get('/', [WorkController::class, 'ListWork']); 
        Route::get('/job-details/{id}', [WorkController::class, 'WorkDetail']);     
        Route::get('/update-progress/{id}', [WorkController::class, 'UpdateProgress']); 
        Route::post('/update-progress/{id}', [WorkController::class, 'PostUpdateProgress']); 
        Route::get('/complete-the-work/{id}', [WorkController::class, 'FinishWork']); 
    });

    
    Route::prefix('identity-management')->group(function () {
        Route::get('/', [FaceController::class, 'FaceStaffDetail']);
    });

    Route::prefix('bonus')->group(function () {
        Route::get('/', [BonusController::class, 'ListBonus']);;        
    });
    Route::prefix('discipline')->group(function () {
        Route::get('/', [DisciplineController::class, 'ListDiscipline']);       
    });
    Route::prefix('salary-management')->group(function () {
        Route::get('/', [SalaryController::class, 'ListSalary']); 

    });

    Route::get('/register-faces', [FaceController::class, 'RegisterFace']);
    Route::post('/register-faces', [FaceController::class, 'PostRegisterFace']);

    Route::get('/log-out', [AccountController::class, 'Logout']);
});
Route::get('/time-keeping', [FaceController::class, 'RecordFace']);
Route::post('/face-recognition', [FaceController::class, 'PostRecordFace']);



