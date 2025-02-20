<?php

namespace App\Jobs;

use App\Services\SubscriptionService\Publisher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PriceChangedNotificationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Publisher $publisher)
    {
        //
    }

    public function handle(): void
    {
        $this->publisher->notify();
    }
}
