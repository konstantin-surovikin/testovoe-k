<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\Enums\PaymentTypes;
use Domain\Order\Exceptions\OrderIsNullException;

interface GeneratePaymentUrlServiceInterface
{
    /**
     * @param string $orderUuid
     * @param PaymentTypes $paymentType
     * @return string
     * @throws OrderIsNullException
     */
    public function execute(string $orderUuid, PaymentTypes $paymentType): string;
}