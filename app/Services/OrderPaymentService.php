<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\User;

class OrderPaymentService
{
    public function confirmPayment(int $userId, string $orderUuid): void
    {
        $user = User::findOrFail($userId);
        $order = Order::where('uuid', $orderUuid)
            ->where('entity_id', $user->id)
            ->where('status', 'Unpaid')
            ->firstOrFail();

        $order->update(['status' => 'Paid']);
    }

    public function cancelOrder(int $userId, string $orderUuid): void
    {
        $user = User::findOrFail($userId);
        $order = Order::where('uuid', $orderUuid)
            ->where('entity_id', $user->id)
            ->where('status', 'Unpaid')
            ->firstOrFail();

        $order->update(['status' => 'Denied']);
    }
}
