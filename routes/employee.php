<?php

use App\Http\Controllers\Employee\ApplyLeaveController;
use App\Http\Controllers\Employee\PunchTimeController;
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

    Route::get('/',function(){
        return view('employee.dashboard');
    })->name('dashboard');

    Route::get('get_punch_time',[PunchTimeController::class,'pubchTime'])->name('get_punch_time');
    Route::get('punch_in',[PunchTimeController::class,'punchIn'])->name('punch_in');
    Route::get('break_in',[PunchTimeController::class,'breakIn'])->name('break_in');
    Route::get('break_out',[PunchTimeController::class,'breakOut'])->name('break_out');
    Route::get('punch_out',[PunchTimeController::class,'punchOut'])->name('punch_out');

    Route::get('attendance',[PunchTimeController::class,'attendance'])->name('attendance');
    
    Route::resource('apply_leaves',ApplyLeaveController::class);
    Route::resource('tasks',TaskController::class);

});



