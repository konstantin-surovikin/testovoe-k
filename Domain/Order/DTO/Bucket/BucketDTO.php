<?php

declare(strict_types=1);

namespace Domain\Order\DTO\Bucket;

final readonly class BucketDTO
{
    /**
     * @param string $uuid
     * @param list<PositionDTO> $positions
     */
    public function __construct(
        public string $uuid,
        public array $positions,
    )
    {
    }
}
