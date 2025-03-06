<?php

declare(strict_types=1);

namespace Domain\Order\DTO;

use DateTimeImmutable;
use Domain\Order\Enums\OrderStatuses;

readonly final class OrderFilterDTO
{
    public function __construct(
        public ?DateTimeImmutable $from,
        public ?DateTimeImmutable $to,
        public ?OrderStatuses $status,
    )
    {
    }
}
