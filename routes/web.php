<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityUpdateController;
use App\Http\Controllers\DailyHandoverController;
use App\Http\Controllers\ReportController;

// Public
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Protected
Route::middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('daily.index'));
    Route::resource('activities', ActivityController::class)->only(['index','create','store','show']);
    Route::post('activities/{activity}/logs', [ActivityUpdateController::class, 'store'])->name('activity.logs.store');
    Route::get('/daily', [DailyHandoverController::class, 'index'])->name('daily.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
