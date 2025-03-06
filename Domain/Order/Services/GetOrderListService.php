<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\DTO\GetOrderListDTO;
use Domain\Order\Interfaces\Repository\OrderRepositoryInterface;
use Domain\Order\Interfaces\Service\GetOrderListServiceInterface;

final readonly class GetOrderListService implements GetOrderListServiceInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private GetOrderService $getOrderService
    )
    {
    }

    public function execute(GetOrderListDTO $getOrderListDTO): array
    {
        return array_map(
            $this->getOrderService->execute(...),
            array_column(
                $this->orderRepository
                    ->withPagination($getOrderListDTO->pagination)
                    ->filter($getOrderListDTO->filter),
                'uuid'
            )
        );
    }
}
