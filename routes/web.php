<?php

use App\Http\Controllers\web\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\WebController;

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
    return redirect()->route('admin.index');
});

// Route::resource('web/index', webController::class);

Route::controller(WebController::class)->group(function(){
    Route::get("index","index")->name('web/index');
    Route::get("register","register")->name('web/register');
    Route::post("data","data")->name('web/data');
    Route::get("login","login")->name('web/login');
    Route::post("check","check")->name('web/check');
    Route::get("Product_details","Product_details")->name('web/Product_details');
});

Route::controller(AjaxController::class)->group(function(){
    Route::post("dataCart","dataCart")->name("web/dataCart");
    Route::post("remove","remove")->name("web/remove");
    Route::get("search","search")->name("web/search");
});


