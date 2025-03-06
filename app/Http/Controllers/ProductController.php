<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Product\GetAllRequest;
use Domain\Order\DTO\PaginationDTO;
use Domain\Order\Exceptions\ProductIsNullException;
use Domain\Order\Interfaces\Service\GetProductListServiceInterface;
use Domain\Order\Interfaces\Service\GetProductServiceInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param int $id
     * @param GetProductServiceInterface $getProductService
     * @return JsonResponse
     * @throws ProductIsNullException
     */
    public function getOne(
        int $id,
        GetProductServiceInterface $getProductService
    ): JsonResponse
    {
        return $this->withData($getProductService->execute($id));
    }

    public function getAll(
        GetAllRequest $request,
        GetProductListServiceInterface $getProductListService
    ): JsonResponse
    {
        return $this->withData($getProductListService->execute(
            new PaginationDTO(
                $request->page ?? 0,
                $request->perPage ?? 15,
                $request->sortBy,
                $request->sortOrder
            )
        ));
    }
}
