<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\ResponseDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;

abstract class Controller
{
    public function __construct(
        protected ResponseFactory $responses
    )
    {
    }

    protected function withData(object|array $data = []): JsonResponse
    {
        return $this->responses->json(
            new ResponseDTO(
                true,
                null,
                $data
            )
        );
    }
}
