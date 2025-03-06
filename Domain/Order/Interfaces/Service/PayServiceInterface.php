<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\Enums\PaymentTypes;
use Domain\Order\Exceptions\OrderIsEmptyException;

interface PayServiceInterface
{
    /**
     * @param PaymentTypes $paymentType
     * @return string
     * @throws OrderIsEmptyException
     */
    public function execute(PaymentTypes $paymentType): string;
}
