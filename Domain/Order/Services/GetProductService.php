<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\DTO\ProductDTO;
use Domain\Order\Exceptions\ProductIsNullException;
use Domain\Order\Interfaces\Repository\ProductRepositoryInterface;
use Domain\Order\Interfaces\Service\GetProductServiceInterface;

final readonly class GetProductService implements GetProductServiceInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function execute(int $id): ProductDTO
    {
        $product = $this->productRepository->findById($id);

        if ($product === null) {
            throw new ProductIsNullException();
        }

        return new ProductDTO(
            $product->id,
            $product->name,
            $product->cost,
        );
    }
}
