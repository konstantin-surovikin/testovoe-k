<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CancelPaymentMessage implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly int $id
    )
    {
    }

    public function handle(): void
    {
        Order::where('id', $this->id)
            ->where('status', 'Unpaid')
            ->first()
            ?->update(['status' => 'Denied']);
    }
}
