<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\DTO\Order\OrderDTO;
use Domain\Order\DTO\Order\PositionDTO;
use Domain\Order\DTO\Order\ProductDTO;
use Domain\Order\Exceptions\OrderIsNullException;
use Domain\Order\Interfaces\Repository\OrderRepositoryInterface;
use Domain\Order\Interfaces\Service\GetOrderServiceInterface;

final readonly class GetOrderService implements GetOrderServiceInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
    )
    {
    }

    public function execute(string $uuid): OrderDTO
    {
        $order = $this->orderRepository
            ->findByUuid($uuid);

        if ($order === null) {
            throw new OrderIsNullException();
        }

        $products = [];
        foreach ($order->products as $product) {
            $products[] = new PositionDTO(
                new ProductDTO(
                    $product->name,
                    $product->cost,
                ),
                $product->amount
            );
        }

        return new OrderDTO(
            $order->uuid,
            $order->status,
            $products
        );
    }
}
