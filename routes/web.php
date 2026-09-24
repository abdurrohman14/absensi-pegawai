<?php

use App\Http\Controllers\AttendanceProcessorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::post(
//     '/attendance/process',
//     [AttendanceProcessorController::class, 'process']
// );
