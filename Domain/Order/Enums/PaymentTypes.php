<?php

declare(strict_types=1);

namespace Domain\Order\Enums;

enum PaymentTypes: string
{
    case FIRST = 'First';
    case SECOND = 'Second';
    case THIRD = 'Third';
}
