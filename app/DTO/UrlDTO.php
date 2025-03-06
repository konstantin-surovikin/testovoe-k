<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class UrlDTO
{
    public function __construct(
        public string $url,
    )
    {
    }
}
