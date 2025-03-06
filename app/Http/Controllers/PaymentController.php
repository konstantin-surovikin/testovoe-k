<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Payment\CheckRequest;
use Domain\Order\Exceptions\OrderIsNullException;
use Domain\Order\Interfaces\Service\ConfirmPaymentServiceInterface;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    /**
     * @param CheckRequest $request
     * @param ConfirmPaymentServiceInterface $orderPaymentService
     * @return JsonResponse
     * @throws OrderIsNullException
     */
    public function check(
        CheckRequest $request,
        ConfirmPaymentServiceInterface $orderPaymentService,
    ): JsonResponse
    {
        $orderPaymentService->execute($request->uuid);

        return $this->withData();
    }
}
