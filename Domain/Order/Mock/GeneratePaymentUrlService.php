<?php

declare(strict_types=1);

namespace Domain\Order\Mock;

use Domain\Order\Enums\PaymentTypes;
use Domain\Order\Interfaces\Service\GeneratePaymentUrlServiceInterface;

final readonly class GeneratePaymentUrlService implements GeneratePaymentUrlServiceInterface
{
    public function __construct(
        private string $url
    )
    {
    }

    public function execute(string $orderUuid, PaymentTypes $paymentType): string
    {
        return $this->url;
    }
}