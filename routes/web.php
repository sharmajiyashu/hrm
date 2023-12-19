<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
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




Route::get('/',[Controller::class,'home'])->name('home');
Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('check_login',[LoginController::class,'checkLogin'])->name('check_login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');



Route::group(['as' => 'admin.','prefix' => 'admin'],function () {
    require __DIR__.'/admin.php';
});

Route::group(['as' => 'employee.','prefix' => 'employee'],function () {
    require __DIR__.'/employee.php';
});
