<?php

declare(strict_types=1);

namespace Domain\Order\Enums;

enum OrderStatuses: string
{
    case UNPAID = 'Unpaid';
    case PAID = 'Paid';
    case DENIED = 'Denied';
}
