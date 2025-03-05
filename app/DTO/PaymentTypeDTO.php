<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class PaymentTypeDTO
{
    public function __construct(
        public int $id,
        public string $type,
        public string $name,
    )
    {
    }
}
