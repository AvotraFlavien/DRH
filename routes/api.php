<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('user/create-employe', [EmployeController::class, 'createEmployer']);
Route::post('user/create-employe/account/{employe}', [EmployeController::class, 'createEmployeAccount']);


Route::post('user/connect/verified-mail', [UserController::class, 'verificationMail']);
Route::get('/user/verification/code/{id_user}', [UserController::class, 'verificationUser']);
Route::post('user/connect/verified-password/{user}', [UserController::class, 'verificationPassword']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
