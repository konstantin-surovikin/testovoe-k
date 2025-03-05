<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\PaginationDTO;
use App\Http\Requests\Product\GetAllRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    )
    {
    }

    public function getOne(int $id): JsonResponse
    {
        return response()->json([
            'result' => true,
            'message' => null,
            'data' => $this->productService->getProduct($id),
        ]);
    }

    public function getAll(GetAllRequest $request): JsonResponse
    {
        $paginationDTO = new PaginationDTO(
            $request->page ?? 0,
            $request->perPage ?? 15,
            $request->sortBy,
            $request->sortOrder
        );

        $products = $this->productService->getProducts($paginationDTO);

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => $products,
        ]);
    }
}
