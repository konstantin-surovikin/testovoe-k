<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\Exceptions\ProductIsNullException;
use Domain\Order\Interfaces\Repository\BucketRepositoryInterface;
use Domain\Order\Interfaces\Repository\ProductRepositoryInterface;
use Domain\Order\Interfaces\Service\RemoveProductServiceInterface;
use Domain\Order\Models\Bucket;

final readonly class RemoveProductService implements RemoveProductServiceInterface
{
    public function __construct(
        private BucketRepositoryInterface $bucketRepository,
        private ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function execute(int $id): void
    {
        $bucket = $this->bucketRepository->get() ?? new Bucket();
        $product = $this->productRepository->findById($id);

        if ($product === null) {
            throw new ProductIsNullException();
        }

        $bucket->removeProduct($product);
        $this->bucketRepository->save($bucket);
    }
}