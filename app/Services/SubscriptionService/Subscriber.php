<?php

namespace App\Services\SubscriptionService;

interface Subscriber
{
    public function update(): void;
}
