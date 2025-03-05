<?php

declare(strict_types=1);

namespace App\Services;

class GeneratePaymentUrlService
{
    public function execute(string $paymentType): string
    {
        return route('mock-payment'); // Mock
    }
}
