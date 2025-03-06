<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Order;
use App\Models\Position;
use App\Models\Product as ProductModel;
use App\Models\User;
use Domain\Order\Interfaces\Repository\BucketRepositoryInterface;
use Domain\Order\Models\Bucket;
use Domain\Order\Models\ProductBucket;
use Ramsey\Uuid\UuidFactoryInterface;

class BucketRepository implements BucketRepositoryInterface
{
    const string  STATUS = 'Bucket';

    public function __construct(
        private readonly UuidFactoryInterface $uuidFactory,
        private readonly User $user
    )
    {
    }

    public function get(): ?Bucket
    {
        /** @var Order|null $order */
        $order = Order::where('entity_id', $this->user->id)
            ->where('entity', 'User')
            ->where('status', static::STATUS)
            ->first();

        if ($order === null) {
            return null;
        }

        $products = [];
        foreach ($order->positions as $position) {
            $products[$position->product_id] = new ProductBucket(
                $position->product_id,
                $order->uuid,
                $position->amount
            );
        }

        return new Bucket($order->uuid, $products);
    }

    public function save(Bucket $bucket): void
    {
        $order = Order::where('uuid', $bucket->uuid)
            ->where('entity', 'User')
            ->where('status', static::STATUS)
            ->first();
        $order = $order ?? new Order([
            'uuid' => $bucket->uuid ?? $this->uuidFactory->uuid4()->toString(),
            'entity_id' => $this->user->id,
            'entity' => 'User',
            'status' => static::STATUS
        ]);
        $bucket->uuid = $order->uuid;
        $positions = [];
        /** @var ProductBucket $productBucket */
        foreach ($bucket->getProducts() as $productBucket) {
            $productModel = ProductModel::findOrFail($productBucket->productId);
            $positions[] = new Position([
                'order_id' => $order->id,
                'product_id' => $productModel->id,
                'name' => $productModel->name,
                'cost' => $productModel->cost,
                'amount' => $productBucket->amount,
            ]);
        }
        $order->save();
        Position::where('order_id', $order->id)->delete();
        foreach ($positions as $position) {
            $position->save();
        }
    }
}
