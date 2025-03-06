<?php

declare(strict_types=1);

namespace Domain\Order\DTO\Order;

final readonly class ProductDTO
{
    public function __construct(
        public string $name,
        public int $cost,
    )
    {
    }
}
