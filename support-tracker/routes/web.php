<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityUpdateController;
use App\Http\Controllers\DailyHandoverController;
use App\Http\Controllers\ReportController;

// ─── Guest-only auth routes ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {

    // Registration
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Login
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Forgot password
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Reset password
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// ─── Logout (auth required) ─────────────────────────────────────────────────
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// ─── Protected routes ───────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('daily.index'));
    Route::resource('activities', ActivityController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('activities/{activity}/logs', [ActivityUpdateController::class, 'store'])->name('activity.logs.store');
    Route::get('/daily', [DailyHandoverController::class, 'index'])->name('daily.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
