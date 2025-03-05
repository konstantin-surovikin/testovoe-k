<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class LoginDTO
{
    public function __construct(
        public string $name,
        public string $password,
    )
    {
    }
}
