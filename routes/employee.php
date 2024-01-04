<?php

use App\Http\Controllers\Employee\ApplyLeaveController;
use App\Http\Controllers\Employee\PunchTimeController;
use App\Http\Controllers\Employee\SettingController;
use App\Http\Controllers\Employee\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['employee'])->group(function () {

    Route::get('dashboard',function(){
        return view('employee.dashboard');
    })->name('dashboard');

    Route::group(['as' => 'settings.','prefix' => 'settings','controller' => SettingController::class ],function () {
        Route::get('change-password','changePassword')->name('change_password');
        Route::post('update_password','updatePassword')->name('update_password');
    });

    Route::group(['as' => 'tasks.','prefix' => 'tasks','controller' => TaskController::class ],function () {
        Route::get('update_task_status','updateStatus')->name('change_status');
    });

    Route::get('get_punch_time',[PunchTimeController::class,'pubchTime'])->name('get_punch_time');
    Route::get('punch_in',[PunchTimeController::class,'punchIn'])->name('punch_in');
    Route::get('break_in',[PunchTimeController::class,'breakIn'])->name('break_in');
    Route::get('break_out',[PunchTimeController::class,'breakOut'])->name('break_out');
    Route::get('punch_out',[PunchTimeController::class,'punchOut'])->name('punch_out');

    Route::get('get_in_processing_task',[TaskController::class,'getInProcessingTask'])->name('get_in_processing_task');

    Route::get('attendance',[PunchTimeController::class,'attendance'])->name('attendance');
    
    Route::resource('apply_leaves',ApplyLeaveController::class);
    Route::resource('tasks',TaskController::class);

});



