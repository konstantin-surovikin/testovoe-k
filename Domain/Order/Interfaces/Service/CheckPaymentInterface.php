<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\Exceptions\OrderIsNullException;

interface CheckPaymentInterface
{
    /**
     * @param string $orderUuid
     * @return void
     * @throws OrderIsNullException
     */
    public function execute(string $orderUuid): void;
}
