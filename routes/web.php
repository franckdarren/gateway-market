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

    //Routes Administrateurs et Superviseurs
    Route::group(['middleware' => ['role:Administrateur|Superviseur']], function () {
        Route::get('/investisseurs', function () {
            return view('investisseur');
        })->name('investisseur');

        Route::get('/startups', function () {
            return view('startup');
        })->name('startup');

        Route::get('/demandes', function () {
            return view('demandes');
        })->name('demandes');
    });

    //Routes Administrateurs
    Route::group(['middleware' => ['role:Administrateur']], function () {
        Route::get('/validations-offres', function () {
            return view('validations-offres');
        })->name('validations-offres');

        Route::get('/transactions', function () {
            return view('transaction');
        })->name('transaction');
    });

    //Routes Investisseurs
    Route::group(['middleware' => ['role:Investisseur']], function () {
        Route::get('/remboursements', function () {
            return view('remboursement');
        })->name('remboursement');

        Route::get('/projets', function () {
            return view('projets');
        })->name('projets');

        // Investir sur une offre
        Route::get('/investir/{offre}', [OffreController::class, 'investir'])->name('offre.investir');

        Route::resource('compte_investisseur', CompteInvestisseurController::class);
    });


    //Routes Startups
    Route::group(['middleware' => ['role:Startup']], function () {
        Route::get('/dettes', function () {
            return view('dette');
        })->name('dette');

        Route::resource('compte_startup', CompteStartupController::class);

        Route::get('/offre', [OffreController::class, 'index'])->name('offre.index');

        // Create: Affiche le formulaire de création
        Route::get('/offre/create', [OffreController::class, 'create'])->name('offre.create');

        // Store: Enregistre une nouvelle ressource
        Route::post('/offre', [OffreController::class, 'store'])->name('offre.store');

        // Edit: Affiche le formulaire d'édition pour une ressource spécifique
        Route::get('/offre/{offre}/edit', [OffreController::class, 'edit'])->name('offre.edit');

        // Update: Met à jour une ressource spécifique
        Route::put('/offre/{offre}', [OffreController::class, 'update'])->name('offre.update');

        // Destroy: Supprime une ressource spécifique
        Route::delete('/offre/{offre}', [OffreController::class, 'destroy'])->name('offre.destroy');
    });

    // Routes Startup et Investisseurs
    Route::group(['middleware' => ['role:Startup|Investisseur']], function () {
        Route::get('/historiques', function () {
            return view('historique');
        })->name('historique');

        Route::get('/retrait', function () {
            return view('retrait');
        })->name('retrait');
    });

    // Show: Affiche une ressource spécifique
    Route::get('/offre/{offre}', [OffreController::class, 'show'])->name('offre.show');
});
