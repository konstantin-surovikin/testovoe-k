<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\Enums\OrderStatuses;
use Domain\Order\Exceptions\OrderIsNullException;
use Domain\Order\Interfaces\Repository\OrderRepositoryInterface;
use Domain\Order\Interfaces\Service\ConfirmPaymentServiceInterface;
use Domain\Order\Mock\CheckPaymentService;

final readonly class ConfirmPaymentService implements ConfirmPaymentServiceInterface
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private CheckPaymentService $checkPaymentService,
    )
    {
    }

    public function execute(string $orderUuid): void
    {
        $order = $this->orderRepository->findByUuid($orderUuid);

        if ($order === null) {
            throw new OrderIsNullException();
        }

        $this->checkPaymentService->execute($orderUuid);
        $order->status = OrderStatuses::PAID;
        $this->orderRepository->save($order);
    }
}
