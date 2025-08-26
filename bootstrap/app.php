<?php

use App\Jobs\SubscriptionRenewal;
use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Middleware\AdminUserMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
           'useradmin' => AdminUserMiddleware::class,
        ]);
    })

    ->withSchedule(function (Schedule $schedule) {
        // $schedule->job(new SubscriptionRenewal)->everyMinute();
        // $schedule->command('send-reminder')->daily()->withoutOverlapping();
        $schedule->command('send-reminder')->everyMinute()->withoutOverlapping();
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
