<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriberController;

// Page d’accueil (newsletter, hero…)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Inscription Admin
Route::get('/register', [AuthController::class, 'showRegistrationForm'])
     ->name('register.form');
Route::post('/register', [AuthController::class, 'register'])
     ->name('register.submit');

// Connexion Admin
Route::get('/login', [AuthController::class, 'showLoginForm'])
     ->name('login.form');
Route::post('/login', [AuthController::class, 'login'])
     ->name('login.submit');

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])
     ->middleware('auth')
     ->name('logout');

// Dashboard protégé
Route::get('/dashboard', [AuthController::class, 'dashboard'])
     ->middleware('auth')
     ->name('dashboard');

// Newsletter subscription
Route::post('/subscribe', [SubscriberController::class, 'store'])
     ->name('subscribe');
          
Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [SubscriberController::class, 'index'])->name('dashboard');
        Route::post('/subscribers', [SubscriberController::class, 'store'])->name('subscriber');
    });