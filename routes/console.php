<?php

use App\Console\Commands\DepotCommand;
use App\Console\Commands\ProcessAbonnementPayments;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\RemboursementCommand;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(RemboursementCommand::class, [])->daily();
Schedule::command(ProcessAbonnementPayments::class, [])->daily();

