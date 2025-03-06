<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\UrlDTO;
use App\Http\Requests\Bucket\AddProductRequest;
use App\Http\Requests\Bucket\PayRequest;
use Domain\Order\Enums\PaymentTypes;
use Domain\Order\Exceptions\OrderIsEmptyException;
use Domain\Order\Exceptions\ProductIsNullException;
use Domain\Order\Interfaces\Service\AddProductServiceInterface;
use Domain\Order\Interfaces\Service\GetBucketServiceInterface;
use Domain\Order\Interfaces\Service\PayServiceInterface;
use Domain\Order\Interfaces\Service\RemoveProductServiceInterface;
use Illuminate\Http\JsonResponse;

class BucketController extends Controller
{
    public function getBucket(
        GetBucketServiceInterface $getBucketService,
    ): JsonResponse
    {
        return $this->withData($getBucketService->execute());
    }

    /**
     * @param AddProductRequest $request
     * @param AddProductServiceInterface $addProductService
     * @return JsonResponse
     * @throws ProductIsNullException
     */
    public function addProduct(
        AddProductRequest $request,
        AddProductServiceInterface $addProductService
    ): JsonResponse
    {
        $addProductService->execute($request->id);

        return $this->withData();
    }

    /**
     * @param int $id
     * @param RemoveProductServiceInterface $removeProductService
     * @return JsonResponse
     * @throws ProductIsNullException
     */
    public function removeProduct(
        int $id,
        RemoveProductServiceInterface $removeProductService
    ): JsonResponse
    {
        $removeProductService->execute($id);

        return $this->withData();
    }

    /**
     * @param PayRequest $request
     * @param PayServiceInterface $payService
     * @return JsonResponse
     * @throws OrderIsEmptyException
     */
    public function pay(
        PayRequest $request,
        PayServiceInterface $payService
    ): JsonResponse
    {
        return $this->withData(
            new UrlDTO(
                $payService->execute(PaymentTypes::from($request->payment_type))
            )
        );
    }
}

