<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class PaginationDTO
{
    public function __construct(
        public int $page,
        public int $perPage,
        public ?string $sortBy,
        public ?string $sortOrder,
    )
    {
    }
}
