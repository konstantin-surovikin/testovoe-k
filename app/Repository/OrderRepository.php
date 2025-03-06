<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Order as OrderModel;
use App\Models\PaymentType;
use App\Models\Product as ProductModel;
use Domain\Order\DTO\OrderFilterDTO;
use Domain\Order\DTO\PaginationDTO;
use Domain\Order\Enums\OrderStatuses;
use Domain\Order\Enums\PaymentTypes;
use Domain\Order\Interfaces\Repository\OrderRepositoryInterface;
use Domain\Order\Models\Bucket;
use Domain\Order\Models\Order;
use Domain\Order\Models\Position;
use Domain\Order\Models\ProductBucket;
use SplDoublyLinkedList;

readonly class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(
        private ?PaginationDTO $paginationDTO = null,
    )
    {
    }

    public function findByUuid(string $uuid): ?Order
    {
        /** @var OrderModel $model */
        $model = OrderModel::whereUuid($uuid)
            ->whereIn('status', OrderStatuses::cases())
            ->first();

        if ($model === null) {
            return null;
        }

        $products = new SplDoublyLinkedList();
        foreach ($model->positions as $position) {
            $products->push(
                new Position(
                    $position->name,
                    $position->cost,
                    $position->amount,
                )
            );
        }

        $paymentType = null;
        if ($model->paymentType?->name !== null) {
            $paymentType = PaymentTypes::from($model->paymentType->name);
        }

        return new Order(
            $model->uuid,
            OrderStatuses::from($model->status),
            $products,
            $paymentType,
        );
    }

    public function withPagination(PaginationDTO $pagination): static
    {
        return new self($pagination);
    }

    public function filter(OrderFilterDTO $filter): array
    {
        $query = OrderModel::query();

        if ($filter->from) {
            $query->where('created_at', '>=', $filter->from);
        }
        if ($filter->to) {
            $query->where('created_at', '<=', $filter->to);
        }
        if ($filter->status) {
            $query->where('status', $filter->status);
        }

        $paginationDTO = $this->paginationDTO;
        if ($paginationDTO) {
            if ($paginationDTO->sortBy) {
                $query = $query->orderBy(
                    $paginationDTO->sortBy,
                    strtolower($paginationDTO->sortOrder ?? 'asc')
                );
            }

            return $query
                ->paginate($paginationDTO->perPage, ['*'], 'page', $paginationDTO->page)
                ->all();
        }

        return $query->get()->toArray();
    }

    public function fromBucket(Bucket $bucket): Order
    {
        $products = new SplDoublyLinkedList();
        /** @var ProductBucket $product */
        foreach ($bucket->getProducts() as $product) {
            $productModel = ProductModel::findOrFail($product->productId);
            $products->push(
                new Position(
                    $productModel->name,
                    $productModel->cost,
                    $product->amount,
                )
            );
        }

        return new Order(
            $bucket->uuid,
            OrderStatuses::UNPAID,
            $products,
            null
        );
    }

    public function save(Order $order): void
    {
        /** @var OrderModel $model */
        $model = OrderModel::where('uuid', $order->uuid)->firstOrCreate(['uuid' => $order->uuid]);
        $model->status = $order->status->value;
        $model->payment_type_id = PaymentType::where('name', $order->paymentType?->value ?? '')
            ->pluck('id')
            ->first();
        $model->save();
    }
}
