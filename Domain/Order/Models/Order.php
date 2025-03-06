<?php

declare(strict_types=1);

namespace Domain\Order\Models;

use Domain\Order\Enums\OrderStatuses;
use Domain\Order\Enums\PaymentTypes;

class Order
{
    /**
     * @param string $uuid
     * @param OrderStatuses $status
     * @param iterable<Position> $products
     * @param PaymentTypes|null $paymentType
     */
    public function __construct(
        public string $uuid,
        public OrderStatuses $status,
        public readonly iterable $products,
        public ?PaymentTypes $paymentType = null,
    )
    {
    }
}
