<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// if (!function_exists('tmpfile')) {
//     function tmpfile() {
//         return fopen(tempnam(sys_get_temp_dir(), 'tmp'), 'w+');
//     }
// }

if (!function_exists('tmpfile')) {
    function tmpfile() {
        $tempDir = sys_get_temp_dir();
        $tempFile = tempnam($tempDir, 'tmp');
        return fopen($tempFile, 'w+');
    }
}


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
