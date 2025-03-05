<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\PaginationDTO;
use App\DTO\ProductDTO;
use App\Models\Product;

class ProductService
{
    public function getProduct(int $id): ProductDTO
    {
        $product = Product::findOrFail($id);

        return new ProductDTO(
            $product->id,
            $product->name,
            $product->cost
        );
    }

    public function getProducts(PaginationDTO $paginationDTO): array
    {
        $query = Product::query();

        if ($paginationDTO->sortBy) {
            $query->orderBy($paginationDTO->sortBy, strtolower($paginationDTO->sortOrder));
        }

        $products = $query->paginate($paginationDTO->perPage, ['*'], 'page', $paginationDTO->page);

        return $products->map(function ($product) {
            return new ProductDTO(
                $product->id,
                $product->name,
                $product->cost
            );
        })->toArray();
    }
}
