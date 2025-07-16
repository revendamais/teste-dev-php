<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Validation\ValidationException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: "/api/v1",
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(StartSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
        $exceptions->renderable(function(Throwable $e) {
            $code = $e->getCode();
            $formErrors = null;
            $message = $e->getMessage();
            if ($e instanceof ValidationException) {
                $code = 422;
                $formErrors = $e->errors();
            }
           $code = $code == 0 || is_string($code) ? 501 : $code;
            return response(
                [
                    "code" => $code,
                    "message" => $message,
                    "data" => $formErrors
                ],
                $code
            );
        });
    })->create();
