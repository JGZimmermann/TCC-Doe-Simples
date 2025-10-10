<?php

use App\Http\Controllers\AvailableHourController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/hours', [AvailableHourController::class, 'index']);
Route::post('/register', [UserController::class, 'registerDonor']);
Route::post('/login', [UserController::class, 'loginDonor']);
Route::post('/loginEmployee', [UserController::class, 'loginEmployee']);
Route::post('/donation', [DonationController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/me', [UserController::class, 'loggedUser']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::patch('/donor/{users}', [UserController::class, 'updateDonor']);
    Route::patch('/employee/{users}', [UserController::class, 'updateEmployee']);
    Route::post('/donation/store', [DonationController::class, 'store']);
});

ROute::middleware(['auth:sanctum', 'check.users.admin.attendant'])->group(function () {
    Route::post('/hours', [AvailableHourController::class, 'store']);
    Route::patch('/hours/{id}', [AvailableHourController::class, 'update']);
    Route::delete('/hours/{id}', [AvailableHourController::class, 'destroy']);
    Route::get('/hours/{id}', [AvailableHourController::class, 'show']);
    Route::post('/hours/available/{$id}', [AvailableHourController::class, 'turnHourAvailable']);
    Route::patch('/donation/{$id}', [DonationController::class, 'update']);
    Route::get('/donation', [DonationController::class, 'index']);
    Route::delete('/donation/{id}', [DonationController::class, 'delete']);


    //Alterar middleware, usuário precisa poder acessar também
    Route::get('/donation/{id}', [DonationController::class, 'show']);
});

