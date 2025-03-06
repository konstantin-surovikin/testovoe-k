<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\Exceptions\ProductIsNullException;

interface AddProductServiceInterface
{
    /**
     * @param int $productId
     * @return void
     * @throws ProductIsNullException
     */
    public function execute(int $productId): void;
}
