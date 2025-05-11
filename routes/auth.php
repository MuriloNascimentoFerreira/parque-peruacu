<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\MagicAuthenticatedSessionController;
use App\Http\Controllers\Auth\MagicRegisteredUserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

    /* Visitantes */

    // Mostra rota de realizar login do visitante
    Route::get('magic-login', [MagicAuthenticatedSessionController::class, 'create'])
                ->name('magic-login-create');

    //realiza o login do visitante
    Route::post('magic-login', [MagicAuthenticatedSessionController::class, 'store'])
                ->name('magic-login-store');

    // Rota que faz altentificação do link enviado por email e da acesso ao usuário.
    Route::get('magic-login/{email}', [MagicAuthenticatedSessionController::class, 'authenticate'])
                ->middleware('signed')
                ->name('magic-login-auth');

    // Rota de cadastro de visitante
    Route::get('magic-register', [MagicRegisteredUserController::class, 'create'])
                ->name('magic-register-create');

    // Realiza o cadastro do visitante
    Route::post('magic-register', [MagicRegisteredUserController::class, 'store'])
                ->name('magic-register-store');


});

Route::middleware('auth')->group(function () {

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    /* Permitir que apenas admin autenticado posso criar um funcionário. */
    Route::middleware('admin')->group(function(){
        Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

        Route::post('register', [RegisteredUserController::class, 'store']);

    });

    // Retorna view informando que o email precisa ser verificado ou se caso o email ja foi verificado, redirecionar para cadastrar visita.
    Route::get('verification-notice', EmailVerificationPromptController::class)
        ->name('verification.notice');

});

// O usuário precisa ser um convidado ou está logado para acessar essa rota? não!
// Rota que faz altenticação do link enviado por email e da acesso ao usuário.
Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
->middleware(['signed', 'throttle:6,1'])
->name('verification.verify');

// Rota que envia o link de autenticação para o email do visitante novamente
Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
->middleware('throttle:6,1')
->name('verification.send');
