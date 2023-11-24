<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoanController;
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

Route::middleware(['admin'])->group(function () {

    Route::get('/',[HomeController::class,'dashboard'])->name('dashboard');

    
    Route::resource('employees',EmployeeController::class);
    Route::resource('loans',LoanController::class);
    Route::get('employees.appraisals/{id}',[EmployeeController::class,'appraisal'])->name('employees.appraisals');
    Route::get('employees.loans/{id}',[EmployeeController::class,'loans'])->name('employees.loans');
    Route::post('employees.apprisal_save',[EmployeeController::class,'apprisalSave'])->name('employees.apprisal_save');






});


