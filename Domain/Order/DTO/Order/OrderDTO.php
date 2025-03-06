<?php

declare(strict_types=1);

namespace Domain\Order\DTO\Order;

use Domain\Order\Enums\OrderStatuses;

final readonly class OrderDTO
{
    /**
     * @param string $uuid
     * @param OrderStatuses $status
     * @param list<PositionDTO> $positions
     */
    public function __construct(
        public string $uuid,
        public OrderStatuses $status,
        public array $positions,
    )
    {
    }
}
