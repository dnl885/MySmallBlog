<?php

use App\Http\Controllers\AppPublic\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AppPublic\Auth\ConfirmablePasswordController;
use App\Http\Controllers\AppPublic\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\AppPublic\Auth\EmailVerificationPromptController;
use App\Http\Controllers\AppPublic\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AppPublic\Auth\RegisteredUserController;
use App\Http\Controllers\AppPublic\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('user.store');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('user.login');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password-request');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password-update');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification-notice');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password-confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->name('password-confirm');

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('user.logout');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->name('verification.verify');
});

Route::middleware(['auth','throttle:6,1'])->group(function (){
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->name('verification.send');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->name('verification.verify');
});




