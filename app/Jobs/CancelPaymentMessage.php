<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CancelPaymentMessage implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $uuid
    )
    {
    }

    public function handle(): void
    {
        Order::where('uuid', $this->uuid)
            ->where('status', 'Unpaid')
            ->first()
            ?->update(['status' => 'Denied']);
    }
}
