<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\InvestissementCommand;
use App\Console\Commands\RetraitCommand;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(InvestissementCommand::class, [])->everyFiveMinutes();
Schedule::command(RetraitCommand::class, [])->everyFiveMinutes();
