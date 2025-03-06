<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

class MockPaymentController extends Controller
{
    public function mockPay(): JsonResponse
    {
        return response()->json([
            'url' => route('payment.check', [
                'uuid' => Order::where('entity_id', auth()->id())->firstOrFail()->uuid,
            ]),
        ]);
    }
}

