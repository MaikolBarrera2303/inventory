<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ResponsibleController;
use App\Http\Controllers\TypeDeviceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return redirect(route("login"));
});

Route::get("login",[AuthController::class,"index"])->name("login");
Route::post("login",[AuthController::class,"login"]);
Route::post("logout",[AuthController::class,"logout"])->name("logout");

Route::middleware("authentication")->group(function (){

    Route::resource("accessories",AccessoryController::class);

    Route::resource("devices",DeviceController::class);

    Route::resource("users",UserController::class)->except("show","edit","create");

    Route::resource("responsibles",ResponsibleController::class)->except("show","edit","create");

    Route::resource("type-devices",TypeDeviceController::class)->only("index","store","destroy","update");

});
