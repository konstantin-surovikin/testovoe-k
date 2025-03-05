<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Bucket\AddProductRequest;
use App\Http\Requests\Bucket\PayRequest;
use App\Services\BucketService;
use Exception;
use Illuminate\Http\JsonResponse;

class BucketController extends Controller
{
    public function __construct(
        private readonly BucketService $bucketService
    )
    {
    }

    public function getBucket(): JsonResponse
    {
        $bucketDTO = $this->bucketService->getBucket(auth()->id());

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => $bucketDTO,
        ]);
    }

    public function addProduct(AddProductRequest $request): JsonResponse
    {
        $this->bucketService->addProduct(auth()->id(), $request->id);

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => null,
        ]);
    }

    public function removeProduct(int $id): JsonResponse
    {
        $this->bucketService->removeProduct(auth()->id(), $id);

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => null,
        ]);
    }

    /**
     * @param PayRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function pay(PayRequest $request): JsonResponse
    {
        $paymentLink = $this->bucketService->payOrder(auth()->id(), $request->payment_type);

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => $paymentLink,
        ]);
    }
}

