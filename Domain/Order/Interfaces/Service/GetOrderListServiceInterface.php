<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\DTO\GetOrderListDTO;
use Domain\Order\DTO\Order\OrderDTO;

interface GetOrderListServiceInterface
{
    /**
     * @param GetOrderListDTO $getOrderListDTO
     * @return list<OrderDTO>
     */
    public function execute(GetOrderListDTO $getOrderListDTO): array;
}
