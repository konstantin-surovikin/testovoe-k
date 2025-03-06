<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\Exceptions\ProductIsNullException;

interface RemoveProductServiceInterface
{
    /**
     * @param int $id
     * @return void
     * @throws ProductIsNullException
     */
    public function execute(int $id): void;
}
