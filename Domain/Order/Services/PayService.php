<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use App\Jobs\CancelPaymentMessage;
use DateInterval;
use Domain\Order\Enums\PaymentTypes;
use Domain\Order\Exceptions\OrderIsEmptyException;
use Domain\Order\Interfaces\Repository\BucketRepositoryInterface;
use Domain\Order\Interfaces\Repository\OrderRepositoryInterface;
use Domain\Order\Interfaces\Service\GeneratePaymentUrlServiceInterface;
use Domain\Order\Interfaces\Service\PayServiceInterface;
use Domain\Order\Models\Bucket;
use Illuminate\Contracts\Queue\Queue;

final readonly class PayService implements PayServiceInterface
{
    public function __construct(
        private GeneratePaymentUrlServiceInterface $generatePaymentUrlService,
        private OrderRepositoryInterface $orderRepository,
        private BucketRepositoryInterface $bucketRepository,
        private Queue $queue
    )
    {
    }

    public function execute(PaymentTypes $paymentType): string
    {
        $bucket = $this->bucketRepository->get() ?? new Bucket();

        if ($bucket->getProducts()->count() === 0) {
            throw new OrderIsEmptyException();
        }

        $order = $this->orderRepository->fromBucket($bucket);
        $url = $this->generatePaymentUrlService->execute($order->uuid, $paymentType);
        $this->queue->later(new DateInterval('PT2M'), new CancelPaymentMessage($order->uuid));
        $this->orderRepository->save($order);

        return $url;
    }
}
