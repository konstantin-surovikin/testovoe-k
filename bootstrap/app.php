<?php

declare(strict_types=1);

use App\DTO\ResponseDTO;
use App\Exceptions\InvalidCredentialsException;
use Domain\Order\Exceptions\OrderIsEmptyException;
use Domain\Order\Exceptions\OrderIsNullException;
use Domain\Order\Exceptions\ProductIsNullException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withExceptions(static function (Exceptions $exceptions) {
        $withError = static fn(string $message, int $code, array $errors = []) => response()
            ->json(new ResponseDTO(false, $message, $errors), $code);

        $exceptions->render(
            static fn(InvalidCredentialsException $exception): JsonResponse => $withError(
                $exception->getMessage(),
                401
            )
        );

        $exceptions->render(
            static fn(ModelNotFoundException $exception): JsonResponse => $withError(
                'Resource not found',
                404
            )
        );

        $exceptions->render(
            static fn(OrderIsEmptyException $exception): JsonResponse => $withError(
                'Order is empty',
                404
            )
        );

        $exceptions->render(
            static fn(OrderIsNullException $exception): JsonResponse => $withError(
                'Order does not exist',
                404
            )
        );

        $exceptions->render(
            static fn(ProductIsNullException $exception): JsonResponse => $withError(
                'Product does not exist',
                404
            )
        );

        $exceptions->render(
            static fn(ValidationException $exception): JsonResponse => $withError(
                $exception->getMessage(),
                422,
                $exception->errors()
            )
        );

        $exceptions->render(
            static fn(ProductIsNullException $exception): JsonResponse => $withError(
                $exception->getMessage(),
                500
            )
        );
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
