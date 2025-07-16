<?php

use App\Jobs\AutomationJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('log', function(){
    fwrite(STDOUT, "Runing...");
    Log::info("Task scheduled running...");
    dispatch_sync(new AutomationJob());
})->everyFiveSeconds();

//Schedule::job(new AutomationJob)->everyFiveSeconds();
