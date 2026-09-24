<?php

use App\Http\Controllers\AttendanceProcessorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/attendance/view',
    [AttendanceProcessorController::class, 'view']
);

