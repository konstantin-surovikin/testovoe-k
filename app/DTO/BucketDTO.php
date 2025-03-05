<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class BucketDTO
{
    public function __construct(
        public string $uuid,
        public string $status,
        public array $products,
    )
    {
    }
}
