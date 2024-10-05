<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Laravel\Configuration\WebRouteDirectoryBuilder;

$default = [__DIR__.'/../routes/web.php'];
$builder = WebRouteDirectoryBuilder::build(__DIR__."/../app/");
$routersWebPaths = array_merge($default, $builder);

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: $routersWebPaths,
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
