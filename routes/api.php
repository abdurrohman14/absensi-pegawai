<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceProcessorController;

use App\Http\Controllers\FingerprintWebhookController;

Route::post(
    '/attendance/process',
    [AttendanceProcessorController::class, 'process']
);


Route::post(
    '/fingerprint/webhook',
    [FingerprintWebhookController::class, 'handle']
);
