<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Product as ProductModel;
use Domain\Order\DTO\PaginationDTO;
use Domain\Order\Interfaces\Repository\ProductRepositoryInterface;
use Domain\Order\Models\Product;

readonly class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private ?PaginationDTO $paginationDTO = null,
    )
    {
    }

    public function findById(int $id): ?Product
    {
        /** @var ProductModel $model */
        $model = ProductModel::find($id);

        if ($model === null) {
            return null;
        }

        return new Product(
            $model->name,
            $model->cost,
            $model->id,
        );
    }

    public function withPagination(PaginationDTO $paginationDTO): static
    {
        return new self($paginationDTO);
    }

    public function all(): array
    {
        $query = ProductModel::query();
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
}