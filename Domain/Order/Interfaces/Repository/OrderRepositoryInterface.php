<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Repository;

use Domain\Order\DTO\OrderFilterDTO;
use Domain\Order\DTO\PaginationDTO;
use Domain\Order\Models\Bucket;
use Domain\Order\Models\Order;

interface OrderRepositoryInterface
{
    /**
     * @param string $uuid
     * @return Order|null
     */
    public function findByUuid(string $uuid): ?Order;

    /**
     * @param PaginationDTO $pagination
     * @return static
     */
    public function withPagination(PaginationDTO $pagination): static;

    /**
     * @return list<Order>
     */
    public function filter(OrderFilterDTO $filter): array;

    /**
     * @param Bucket $bucket
     * @return Order
     */
    public function fromBucket(Bucket $bucket): Order;

    public function save(Order $order): void;
}
