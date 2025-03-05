<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\BucketDTO;
use App\DTO\ProductDTO;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Position;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

final readonly class  BucketService
{
    public function __construct(
        private GeneratePaymentUrlService $generatePaymentUrlService,
    )
    {
    }

    public function getBucket(int $userId): BucketDTO
    {
        $user = User::findOrFail($userId);

        $order = Order::firstOrCreate([
            'entity_id' => $user->id,
            'entity' => 'User',
            'status' => 'Bucket',
        ], [
            'uuid' => Str::uuid(),
        ]);

        $products = $order->positions->map(function (Position $position) {
            return new ProductDTO(
                $position->product->id,
                $position->product->name,
                $position->product->cost
            );
        })->toArray();

        return new BucketDTO(
            $order->uuid,
            $order->status,
            $products
        );
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return void
     * @throws Throwable
     */
    public function addProduct(int $userId, int $productId): void
    {
        DB::transaction(static function () use ($userId, $productId) {
            $user = User::findOrFail($userId);
            $product = Product::findOrFail($productId);

            $order = Order::firstOrCreate([
                'entity_id' => $user->id,
                'entity' => 'User',
                'status' => 'Bucket',
            ], [
                'uuid' => Str::uuid(),
            ]);

            $position = Position::firstOrCreate([
                'order_id' => $order->id,
                'product_id' => $product->id,
            ], [
                'name' => $product->name,
                'cost' => $product->cost,
                'amount' => 0,
            ]);

            $position->increment('amount');
        });
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return void
     * @throws Throwable
     */
    public function removeProduct(int $userId, int $productId): void
    {
        DB::transaction(static function () use ($userId, $productId) {
            $user = User::findOrFail($userId);
            $product = Product::findOrFail($productId);

            $order = Order::where('entity_id', $user->id)
                ->where('entity', 'User')
                ->where('status', 'Bucket')
                ->firstOrFail();

            $position = Position::where('order_id', $order->id)
                ->where('product_id', $product->id)
                ->firstOrFail();

            if ($position->amount > 1) {
                $position->decrement('amount');
            } else {
                $position->delete();
            }
        });
    }

    /**
     * @param int $userId
     * @param string $paymentType
     * @return string
     * @throws Exception
     */
    public function payOrder(int $userId, string $paymentType): string
    {
        $user = User::findOrFail($userId);

        $order = Order::firstOrCreate([
            'entity_id' => $user->id,
            'entity' => 'User',
            'status' => 'Bucket',
        ], [
            'uuid' => Str::uuid(),
        ]);

        if ($order->positions->isEmpty()) {
            throw new Exception('Order is empty');
        }

        $order->update([
            'status' => 'Unpaid',
            'payment_type_id' => PaymentType::where(['type' => $paymentType])->pluck('id')->first(),
        ]);

        // TODO send to kafka
        // Kafka::publish('order_unpaid', ['order_id' => $order->id]);

        return $this->generatePaymentUrlService->execute($paymentType);
    }

}

