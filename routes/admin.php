<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\auth\LoginController;
use App\Http\Controllers\dashboard\admin\adminController;
use App\Http\Controllers\dashboard\admin\productController;
use App\Http\Controllers\dashboard\auth\LoginCheckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource("admin",adminController::class)->middleware('AdminAuth');

Route::resource('product',productController::class)->middleware('AdminAuth');

Route::get('login',[LoginController::class,'index'])->name('admin/login')->middleware("guest:admin");

Route::controller(LoginCheckController::class)->group(function(){
    Route::post("login/check","check")->name('admin/LoginCheck');
    Route::get("logout","logout")->name('admin/Logout');
});
