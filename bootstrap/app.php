<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withExceptions(static function (Exceptions $exceptions) {
        $exceptions->report(static function (ValidationException $exception): JsonResponse {
            return response()->json([
                'result' => false,
                'message' => $exception->getMessage(),
                'data' => null,
            ], 422);
        });

        $exceptions->report(static function (ModelNotFoundException $exception): JsonResponse {
            return response()->json([
                'result' => false,
                'message' => 'Resource not found',
                'data' => null,
            ], 404);
        });

        $exceptions->report(static function (Throwable $exception): JsonResponse {
            return response()->json([
                'result' => false,
                'message' => $exception->getMessage(),
                'data' => null,
            ], 500);
        });
    })
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: '',
    )
    ->withMiddleware(static function (Middleware $middleware): void {
    })
    ->create();
