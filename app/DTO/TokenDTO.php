<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class TokenDTO
{
    public function __construct(
        public BearerTokenDTO $bearerToken,
    )
    {
    }
}
