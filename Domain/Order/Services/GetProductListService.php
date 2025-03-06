<?php

declare(strict_types=1);

namespace Domain\Order\Services;

use Domain\Order\DTO\PaginationDTO;
use Domain\Order\Interfaces\Repository\ProductRepositoryInterface;
use Domain\Order\Interfaces\Service\GetProductListServiceInterface;

final readonly class GetProductListService implements GetProductListServiceInterface
{
    public function __construct(
        private ProductRepositoryInterface $orderRepository,
        private GetProductService $getProductService
    )
    {
    }

    public function execute(PaginationDTO $paginationDTO): array
    {
        return array_map(
            $this->getProductService->execute(...),
            array_column(
                $this->orderRepository
                    ->withPagination($paginationDTO)
                    ->all(),
                'id'
            )
        );
    }
}
