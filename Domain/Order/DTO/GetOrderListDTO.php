<?php

declare(strict_types=1);

namespace Domain\Order\DTO;

final readonly class GetOrderListDTO
{
    public function __construct(
        public PaginationDTO $pagination,
        public OrderFilterDTO $filter,
    )
    {
    }
}
