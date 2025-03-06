<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\Exceptions\ProductIsNullException;
use Domain\Order\Interfaces\Repository\BucketRepositoryInterface;
use Domain\Order\Interfaces\Repository\ProductRepositoryInterface;
use Domain\Order\Interfaces\Service\AddProductServiceInterface;
use Domain\Order\Models\Bucket;

final readonly class AddProductService implements AddProductServiceInterface
{
    public function __construct(
        private BucketRepositoryInterface $bucketRepository,
        private ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function execute(int $productId): void
    {
        $product = $this->productRepository->findById($productId);

        if ($product === null) {
            throw new ProductIsNullException();
        }

        $bucket = $this->bucketRepository->get() ?? new Bucket();
        $this->bucketRepository->save($bucket);
        $bucket->addProduct($product);
        $this->bucketRepository->save($bucket);
    }
}
