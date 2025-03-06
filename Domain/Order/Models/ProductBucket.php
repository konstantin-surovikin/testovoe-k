<?php

declare(strict_types=1);

namespace Domain\Order\Models;

class ProductBucket
{
    public function __construct(
        public int $productId,
        public string $bucketUuid,
        public int $amount,
    )
    {
    }
}
