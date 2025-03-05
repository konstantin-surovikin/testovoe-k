<?php

declare(strict_types=1);

namespace App\DTO;

final class OrderFilterDTO
{
    public function __construct(
        public readonly ?\DateTimeImmutable $from,
        public readonly ?\DateTimeImmutable $to,
        public readonly ?string $status,
    )
    {
    }
}
