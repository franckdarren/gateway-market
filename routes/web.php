<?php

use App\Models\Offre;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffreController;
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

    //Page d'acceuil
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    //Routes admins
    Route::get('/validations-offres', function () {
        return view('validations-offres');
    })->name('validations-offres');
    Route::get('/investisseurs', function () {
        return view('investisseur');
    })->name('investisseur');
    Route::get('/startups', function () {
        return view('startup');
    })->name('startup');
    Route::get('/transactions', function () {
        return view('transaction');
    })->name('transaction');
    Route::get('/demandes', function () {
        return view('demandes');
    })->name('demandes');

    //Routes Investisseurs
    Route::get('/remboursements', function () {
        return view('remboursement');
    })->name('remboursement');

    Route::get('/projets', function () {
        return view('projets');
    })->name('projets');

    //Routes Startups
    Route::get('/dettes', function () {
        return view('dette');
    })->name('dette');

    Route::get('/historiques', function () {
        return view('historique');
    })->name('historique');

    Route::get('/retrait', function () {
        return view('retrait');
    })->name('retrait');

    Route::get('/investir/{offre}', [OffreController::class, 'investir'])->name('offre.investir');
    Route::get('/annuler/{offre}', [OffreController::class, 'annuler'])->name('offre.annuler');


    Route::resource('compte_startup', CompteStartupController::class);
    Route::resource('compte_investisseur', CompteInvestisseurController::class);
    Route::resource('offre', OffreController::class);
});
