<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\DTO\Bucket\BucketDTO;
use Domain\Order\DTO\Bucket\PositionDTO;
use Domain\Order\DTO\Bucket\ProductDTO;
use Domain\Order\Interfaces\Repository\BucketRepositoryInterface;
use Domain\Order\Interfaces\Repository\ProductRepositoryInterface;
use Domain\Order\Interfaces\Service\GetBucketServiceInterface;
use Domain\Order\Models\Bucket;
use Domain\Order\Models\ProductBucket;

final readonly class GetBucketService implements GetBucketServiceInterface
{
    public function __construct(
        private BucketRepositoryInterface $bucketRepository,
        private ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function execute(): BucketDTO
    {
        $bucket = $this->bucketRepository->get() ?? new Bucket();
        $this->bucketRepository->save($bucket);

        $products = [];
        /** @var ProductBucket $productBucket */
        foreach ($bucket->getProducts() as $productBucket) {
            $product = $this->productRepository->findById($productBucket->productId);
            if ($product !== null) {
                $products[] = new PositionDTO(
                    new ProductDTO(
                        $product->id,
                        $product->name,
                        $product->cost,
                    ),
                    $productBucket->amount
                );
            }
        }

        return new BucketDTO(
            $bucket->uuid,
            $products
        );
    }
}