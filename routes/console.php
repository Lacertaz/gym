<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('expired', function () {
    $this->call('gym:expired');
})->dailyAt('00:00')->onFailure(function () {
    Log::error('Failed to check expired memberships');
});
