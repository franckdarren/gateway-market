<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteStartupController;
use App\Http\Controllers\CompteInvestisseurController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('compte_startup', CompteStartupController::class);
Route::resource('compte_investisseur', CompteInvestisseurController::class);
