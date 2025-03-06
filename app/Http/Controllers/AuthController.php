<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\LoginDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     * @throws Exception
     */
    public function login(
        LoginRequest $request,
        AuthService $authService,
    ): JsonResponse
    {
        return $this->withData(
            $authService->login(
                new LoginDTO(
                    $request->get('name'),
                    $request->get('password')
                )
            )
        );
    }
}
