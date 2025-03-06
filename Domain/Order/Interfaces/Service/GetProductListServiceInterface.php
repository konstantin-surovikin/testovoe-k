<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\DTO\PaginationDTO;
use Domain\Order\DTO\ProductDTO;

interface GetProductListServiceInterface
{
    /**
     * @param PaginationDTO $paginationDTO
     * @return list<ProductDTO>
     */
    public function execute(PaginationDTO $paginationDTO): array;
}
