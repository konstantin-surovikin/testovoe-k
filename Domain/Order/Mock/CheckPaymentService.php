<?php

declare(strict_types=1);

namespace Domain\Order\Mock;

use Domain\Order\Interfaces\Service\CheckPaymentInterface;

final readonly class CheckPaymentService implements CheckPaymentInterface
{
    public function execute(string $orderUuid): void
    {
    }
}
