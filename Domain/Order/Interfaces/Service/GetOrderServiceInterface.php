<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\DTO\Order\OrderDTO;
use Domain\Order\Exceptions\OrderIsNullException;

interface GetOrderServiceInterface
{
    /**
     * @param string $uuid
     * @return OrderDTO
     * @throws OrderIsNullException
     */
    public function execute(string $uuid): OrderDTO;
}
