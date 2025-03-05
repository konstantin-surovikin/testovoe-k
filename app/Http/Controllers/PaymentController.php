<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Payment\CheckRequest;
use App\Services\OrderPaymentService;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function __construct()
    {
    }

    public function check(
        CheckRequest $request,
        OrderPaymentService $orderPaymentService,
    ): JsonResponse
    {
        $orderPaymentService->confirmPayment(auth()->id(), $request->uuid);

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => null,
        ]);
    }
}

