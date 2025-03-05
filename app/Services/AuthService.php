<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\BearerTokenDTO;
use App\DTO\LoginDTO;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param LoginDTO $loginDTO
     * @return BearerTokenDTO
     * @throws Exception
     */
    public function login(LoginDTO $loginDTO): BearerTokenDTO
    {
        $user = User::where('name', $loginDTO->name)->firstOrFail();

        if (!Hash::check($loginDTO->password, $user->password)) {
            // TODO Specific Exception
            throw new Exception('Invalid credentials');
        }

        return new BearerTokenDTO($user->createToken('token-name')->plainTextToken);
    }
}
