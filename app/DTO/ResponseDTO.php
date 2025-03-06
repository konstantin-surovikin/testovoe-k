<?php

declare(strict_types=1);

namespace App\DTO;

use stdClass;

final readonly class ResponseDTO
{
    public function __construct(
        public bool $result,
        public ?string $message = null,
        public object|array $data = [],
    )
    {
    }
}
