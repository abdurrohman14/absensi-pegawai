<?php

use App\Http\Controllers\AttendanceProcessorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'Login'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    // View dashboard
    Route::get(
        '/attendance/view',
        [AttendanceProcessorController::class, 'view']
    )->name('attendance.view');

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'Logout'])->name('logout');
});
