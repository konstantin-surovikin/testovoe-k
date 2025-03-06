<?php

declare(strict_types=1);

namespace Domain\Order\Models;

class Position
{
    public function __construct(
        public string $name,
        public int $cost,
        public int $amount,
    )
    {
    }
}
