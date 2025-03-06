<?php

declare(strict_types=1);

namespace Domain\Order\DTO\Bucket;

final readonly class ProductDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public int $cost,
    )
    {
    }
}
