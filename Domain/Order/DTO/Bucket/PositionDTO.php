<?php

declare(strict_types=1);

namespace Domain\Order\DTO\Bucket;

final readonly class PositionDTO
{
    public function __construct(
        public ProductDTO $product,
        public int $amount,
    )
    {
    }
}
