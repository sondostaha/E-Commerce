<?php

// use App\Http\Controllers\ProviderAuth\AuthenticatedSessionController;
// use App\Http\Controllers\ProviderAuth\ConfirmablePasswordController;
// use App\Http\Controllers\ProviderAuth\EmailVerificationNotificationController;
// use App\Http\Controllers\ProviderAuth\EmailVerificationPromptController;
// use App\Http\Controllers\ProviderAuth\NewPasswordController;
// use App\Http\Controllers\ProviderAuth\PasswordController;
// use App\Http\Controllers\ProviderAuth\PasswordResetLinkController;
// use App\Http\Controllers\ProviderAuth\RegisteredUserController;
// use App\Http\Controllers\ProviderAuth\VerifyEmailController;
// use Illuminate\Support\Facades\Route;

// Route::middleware('guest:provider')->group(function () {
//     Route::get('register', [RegisteredUserController::class, 'create'])
//                 ->name('provider.register');

//     Route::post('register', [RegisteredUserController::class, 'store'])->name('provider.providerregister');

//     Route::get('login', [AuthenticatedSessionController::class, 'create'])
//                 ->name('provider.login');

//     Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('provider.providerlogin');

//     Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//                 ->name('provider.password.request');

//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//                 ->name('provider.password.email');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//                 ->name('provider.password.reset');

//     Route::post('reset-password', [NewPasswordController::class, 'store'])
//                 ->name('provider.password.store');
// });

// Route::middleware('auth:provider')->group(function () {
//     Route::get('verify-email', EmailVerificationPromptController::class)
//                 ->name('provider.verification.notice');

//     Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
//                 ->middleware(['signed', 'throttle:6,1'])
//                 ->name('provider.verification.verify');

//     Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//                 ->middleware('throttle:6,1')
//                 ->name('provider.verification.send');

//     Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
//                 ->name('provider.password.confirm');

//     Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

//     Route::put('password', [PasswordController::class, 'update'])->name('provider.password.update');

//     Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
//                 ->name('provide.logout');
// });
