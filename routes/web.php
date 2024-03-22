<?php

use App\Http\Controllers\Auth\MagicAuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Rotas de autenticação */
Route::get('magic-login', [MagicAuthenticatedSessionController::class, 'create'])->name('magic-login-create');

Route::post('magic-login', [MagicAuthenticatedSessionController::class, 'store'])->name('magic-login-store');

Route::get('magic-login/{email}', [MagicAuthenticatedSessionController::class, 'authenticate'])
    ->name('magic-login-auth')
    ->middleware('signed');
