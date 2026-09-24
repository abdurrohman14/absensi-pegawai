<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceProcessorController;

Route::post(
    '/attendance/process',
    [AttendanceProcessorController::class, 'process']
);
