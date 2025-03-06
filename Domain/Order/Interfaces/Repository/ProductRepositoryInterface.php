<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Repository;

use Domain\Order\DTO\PaginationDTO;
use Domain\Order\Models\Product;

interface ProductRepositoryInterface
{
    /**
     * @param int $id
     * @return Product|null
     */
    public function findById(int $id): ?Product;

    /**
     * @param PaginationDTO $paginationDTO
     * @return static
     */
    public function withPagination(PaginationDTO $paginationDTO): static;

    /**
     * @return list<Product>
     */
    public function all(): array;
}