<?php

namespace App\Providers;

use App\Models\Transaction;
use Illuminate\Support\Facades\URL;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Ngrok
        if (env(key: 'APP_ENV') !== 'local') {
            URL::forceScheme(scheme: 'https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'Compte Startup' => \App\Models\CompteStartup::class,
            'Compte Investisseur' => \App\Models\CompteInvestisseur::class,
        ]);
    }
}
