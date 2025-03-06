<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\DTO\ProductDTO;
use Domain\Order\Exceptions\ProductIsNullException;

interface GetProductServiceInterface
{
    /**
     * @param int $id
     * @return ProductDTO
     * @throws ProductIsNullException
     */
    public function execute(int $id): ProductDTO;
}
