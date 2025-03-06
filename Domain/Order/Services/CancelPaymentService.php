<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\Enums\OrderStatuses;
use Domain\Order\Exceptions\OrderIsNullException;
use Domain\Order\Interfaces\Repository\OrderRepositoryInterface;
use Domain\Order\Interfaces\Service\CancelPaymentServiceInterface;

final readonly class CancelPaymentService implements CancelPaymentServiceInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
    )
    {
    }

    public function execute(string $orderUuid): void
    {
        $order = $this->orderRepository->findByUuid($orderUuid);

        if ($order === null) {
            throw new OrderIsNullException();
        }

        if ($order->status === OrderStatuses::UNPAID) {
            $order->status = OrderStatuses::DENIED;
            $this->orderRepository->save($order);
        }
    }
}
