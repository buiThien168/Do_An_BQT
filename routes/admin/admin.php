<?php

use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\StaffManage\StaffManageController;
use App\Http\Controllers\Admin\UserManage\UserManageController;
use App\Http\Controllers\Admin\Department\DepartmentController;
use App\Http\Controllers\Admin\Position\PositionController;
use App\Http\Controllers\Admin\Level\LevelController;
use App\Http\Controllers\Admin\Specialize\SpecializeController;
use App\Http\Controllers\Admin\TypeStaff\TypeStaffController;
use App\Http\Controllers\Admin\Salary\SalaryController;
use App\Http\Controllers\Admin\Bonus\BonusController;
use App\Http\Controllers\Admin\Discipline\DisciplineController;
use App\Http\Controllers\Admin\Infomation\InfomationController;
use App\Http\Controllers\Admin\ChangePassword\ChangePasswordController;
use App\Http\Controllers\Admin\Work\WorkController;
use App\Http\Controllers\Admin\EmailCampaign\EmailCampaignController;
use App\Http\Controllers\Admin\Face\FaceController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'checkadmin'], function () {
        Route::get('log-out', [AccountController::class, 'Logout']);
        Route::prefix('user-management')->group(function () {
            Route::get('/', [StaffManageController::class, 'ListStaff']);
            Route::get('detail/{id}', [StaffManageController::class, 'StaffDetail']);
            Route::get('lock-mine-employee/{id}', [StaffManageController::class, 'BlockUnBlockUser']);
            Route::get('search', [StaffManageController::class, 'SearchUser']);

            Route::get('add-employees', [StaffManageController::class, 'AddStaff']);
            Route::post('add-employees', [StaffManageController::class, 'PostAddStaff']);
            Route::get('edit/{id}', [StaffManageController::class, 'EditStaff']);
            Route::post('edit/{id}', [StaffManageController::class, 'PostEditStaff']);
            Route::get('delete/{id}', [StaffManageController::class, 'DeleteStaff']);
        });
        Route::prefix('account-management')->group(function () {
            Route::get('/', [UserManageController::class, 'ListUser']);
            Route::get('detail/{id}', [UserManageController::class, 'StaffDetail']);
            Route::get('lock-mine-employee/{id}', [UserManageController::class, 'BlockUnBlockUser']);
            Route::get('search', [UserManageController::class, 'SearchUser']);
        });

        Route::prefix('department-manager')->group(function () {
            Route::get('/', [DepartmentController::class, 'ListDepartment']); 
            Route::get('/add', [DepartmentController::class, 'AddDepartment']); 
            Route::post('/add', [DepartmentController::class, 'PostAddDepartment']);   
            Route::get('/delete/{id}', [DepartmentController::class, 'DeleteDepartment']); 
            Route::get('/edit/{id}', [DepartmentController::class, 'EditDepartment']); 
            Route::post('/edit/{id}', [DepartmentController::class, 'PostEditDepartment']);
            Route::get('/see-employee/{id}', [DepartmentController::class, 'ListStaff']);          
        });

        Route::prefix('position-management')->group(function () {
            Route::get('/', [PositionController::class, 'ListPosition']); 
            Route::get('/add', [PositionController::class, 'AddPosition']); 
            Route::post('/add', [PositionController::class, 'PostAddPosition']);   
            Route::get('/delete/{id}', [PositionController::class, 'DeletePosition']); 
            Route::get('/edit/{id}', [PositionController::class, 'EditPosition']); 
            Route::post('/edit/{id}', [PositionController::class, 'PostEditPosition']); 
            Route::get('/see-employee/{id}', [PositionController::class, 'ListStaff']);         
        });
        Route::prefix('level-management')->group(function () {
            Route::get('/', [LevelController::class, 'ListLevel']); 
            Route::get('/add', [LevelController::class, 'AddLevel']); 
            Route::post('/add', [LevelController::class, 'PostAddLevel']);   
            Route::get('/delete/{id}', [LevelController::class, 'DeleteLevel']); 
            Route::get('/edit/{id}', [LevelController::class, 'EditLevel']); 
            Route::post('/edit/{id}', [LevelController::class, 'PostEditLevel']);  
            Route::get('/see-employee/{id}', [LevelController::class, 'ListStaff']);           
        });
        Route::prefix('professional-management')->group(function () {
            Route::get('/', [SpecializeController::class, 'ListSpecialize']); 
            Route::get('/add', [SpecializeController::class, 'AddSpecialize']); 
            Route::post('/add', [SpecializeController::class, 'PostAddSpecialize']);   
            Route::get('/delete/{id}', [SpecializeController::class, 'DeleteSpecialize']); 
            Route::get('/edit/{id}', [SpecializeController::class, 'EditSpecialize']); 
            Route::post('/edit/{id}', [SpecializeController::class, 'PostEditSpecialize']);  
            Route::get('/see-employee/{id}', [SpecializeController::class, 'ListStaff']);        
        });
        Route::prefix('manage-employee-type')->group(function () {
            Route::get('/', [TypeStaffController::class, 'ListTypeStaff']); 
            Route::get('/add', [TypeStaffController::class, 'AddTypeStaff']); 
            Route::post('/add', [TypeStaffController::class, 'PostAddTypeStaff']);   
            Route::get('/delete/{id}', [TypeStaffController::class, 'DeleteTypeStaff']); 
            Route::get('/edit/{id}', [TypeStaffController::class, 'EditTypeStaff']); 
            Route::post('/edit/{id}', [TypeStaffController::class, 'PostEditTypeStaff']);
            Route::get('/see-employee/{id}', [TypeStaffController::class, 'ListStaff']);          
        });

        Route::prefix('salary-management')->group(function () {
            Route::get('/', [SalaryController::class, 'ListSalary']); 
            Route::get('/edit/{id}', [SalaryController::class, 'EditSalary']); 
            Route::post('/edit/{id}', [SalaryController::class, 'PostEditSalary']);
            Route::get('payroll', [SalaryController::class, 'ListSalaryStaff']);  
            Route::get('payroll/detail/{id}', [SalaryController::class, 'ListSalaryStaffDetail']);        
        });
        Route::prefix('bonus')->group(function () {
            Route::get('/', [BonusController::class, 'ListBonus']);
            Route::get('/add', [BonusController::class, 'AddBonus']); 
            Route::post('/add', [BonusController::class, 'PostAddBonus']); 
            Route::get('/edit/{id}', [BonusController::class, 'EditBonus']); 
            Route::post('/edit/{id}', [BonusController::class, 'PostEditBonus']);  
            Route::get('/delete/{id}', [BonusController::class, 'DeleteBonus']);        
        });
        Route::prefix('discipline')->group(function () {
            Route::get('/', [DisciplineController::class, 'ListDiscipline']);
            Route::get('/add', [DisciplineController::class, 'AddDiscipline']); 
            Route::post('/add', [DisciplineController::class, 'PostAddDiscipline']); 
            Route::get('/edit/{id}', [DisciplineController::class, 'EditDiscipline']); 
            Route::post('/edit/{id}', [DisciplineController::class, 'PostEditDiscipline']);  
            Route::get('/delete/{id}', [DisciplineController::class, 'DeleteDiscipline']);        
        });
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
            Route::get('/add', [WorkController::class, 'AddWork']); 
            Route::post('/add', [WorkController::class, 'PostAddWork']); 
            Route::get('/edit/{id}', [WorkController::class, 'EditWork']); 
            Route::post('/edit/{id}', [WorkController::class, 'PostEditWork']);  
            Route::get('/delete/{id}', [WorkController::class, 'DeleteWork']);  
            Route::get('/job-details/{id}', [WorkController::class, 'WorkDetail']);      
        });

        Route::prefix('email-marketing')->group(function () {
            Route::prefix('email-template')->group(function () {
                Route::get('/', [EmailCampaignController::class, 'ListEmailTemplate']);
                Route::get('add', [EmailCampaignController::class, 'AddEmailTemplate']);
                Route::post('add', [EmailCampaignController::class, 'PostAddEmailTemplate']);
                Route::get('delete/{id}', [EmailCampaignController::class, 'DeleteEmailTemplate']);
                Route::get('edit/{id}', [EmailCampaignController::class, 'EditEmailTemplate']);
                Route::post('edit/{id}', [EmailCampaignController::class, 'PostEditEmailTemplate']);
            });   
            Route::prefix('email-config')->group(function () {
                Route::get('/', [EmailCampaignController::class, 'EmailConfig']);
                Route::post('/', [EmailCampaignController::class, 'PostEditEmailConfig']);

            }); 
            Route::prefix('send-mail')->group(function () {
                Route::get('add', [EmailCampaignController::class, 'AddEmailCampaign']);
                Route::post('add', [EmailCampaignController::class, 'PostAddEmailCampaign']);
            });   
        }); 
        Route::prefix('identity-management')->group(function () {
            Route::get('/', [FaceController::class, 'ListFaceStaff']);
            Route::get('/view-data/{id}', [FaceController::class, 'FaceStaffDetail']);
            Route::get('/register-again/{id}', [FaceController::class, 'ResetFaceStaff']);
        });
    });
Route::get('/login', [AccountController::class, 'Login']);
Route::post('/login', [AccountController::class, 'LoginPost']);
});



