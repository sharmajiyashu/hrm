<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
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
    Route::get('time-sheet',[HomeController::class,'timeSheet'])->name('time_sheet');

    
    Route::resource('employees',EmployeeController::class);
    Route::resource('clients',ClientController::class);
    Route::resource('loans',LoanController::class);
    Route::resource('projects',ProjectController::class);
    Route::resource('invoices',InvoiceController::class);
    Route::resource('leaves',LeaveController::class);
    Route::resource('tasks',TaskController::class);

    Route::group(['as' => 'leaves.','prefix' => 'leaves','controller' => LeaveController::class ],function () {
        Route::post('approved_leaves','approvedLeaves')->name('approved_leaves');
    });

    Route::group(['as' => 'invoices.','prefix' => 'invoices','controller' => InvoiceController::class ],function () {
        Route::get('print/{id}','print')->name('print');
    });

    Route::group(['as' => 'clients.','prefix' => 'clients','controller' => ClientController::class ],function () {
        Route::get('invoices/{id}','invoices')->name('invoices');
    });

    Route::group(['as' => 'employees.','prefix' => 'employees','controller' => EmployeeController::class ],function () {
        Route::get('appraisals/{id}', 'appraisal')->name('appraisals');
        Route::get('loans/{id}', 'loans')->name('loans');
        Route::get('salaries/{id}', 'salaries')->name('salaries');
        Route::post('apprisal_save', 'apprisalSave')->name('apprisal_save');
    });


});


