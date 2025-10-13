<?php

use App\Http\Controllers\AvailableHourController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {return view('layouts.home');})->name('home');
Route::get('/donors/register', [UserController::class, 'create'])->name('register.donor.form');
Route::post('/donors/register', [UserController::class, 'registerDonor'])->name('register.donor.store');
Route::get('/login', [UserController::class, 'loginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login.store');
Route::get('/donations/create', [DonationController::class, 'create'])->name('donation.create');
Route::post('/donations/guest', [DonationController::class, 'storeWithoutLogin'])->name('donation.store.guest');
Route::get('/availableHours/{day}', [AvailableHourController::class, 'show'])->name('availableHours.index');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/donations/store', [DonationController::class, 'store'])->name('donation.store');
});

Route::middleware(['check.user.admin'])->group(function () {
    Route::get('/employees/create', [UserController::class, 'createEmployee'])->name('register.employee.form');
    Route::post('/employees/store', [UserController::class, 'registerEmployee'])->name('register.employee.store');
});

Route::middleware(['check.users.admin.attendant'])->group(function () {
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/hours', [AvailableHourController::class, 'create'])->name('register.hour.form');
    Route::post('/hours', [AvailableHourController::class, 'store'])->name('register.hour.store');
    Route::get('/hours/{id}', [AvailableHourController::class, 'availableHourById'])->name('return.hour.id');
    Route::get('/availableHours', [AvailableHourController::class, 'show'])->name('register.hour.index');
    Route::get('/donations', [DonationController::class, 'index'])->name('donation.index');
    Route::get('/donations/all', [DonationController::class, 'allDonations'])->name('donation.all');
    Route::get('/donations/pending', [DonationController::class, 'pendingDonations'])->name('donation.pending');
    Route::get('/donations/accepted', [DonationController::class, 'acceptedDonations'])->name('donation.accepted');
    Route::get('/donations/{id}/accept', [DonationController::class, 'acceptDonation'])->name('return.hour.accept');
    Route::get('/donations/{id}/reject', [DonationController::class, 'rejectDonation'])->name('return.hour.reject');
});
