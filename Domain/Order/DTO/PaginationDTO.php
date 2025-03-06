<?php

declare(strict_types=1);

namespace Domain\Order\DTO;

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
