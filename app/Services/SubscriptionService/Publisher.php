<?php

namespace App\Services\SubscriptionService;
interface Publisher
{
    public function attach(Subscriber $subscriber): void;

    public function detach(Subscriber $subscriber): void;

    public function notify(): void;

    public function getSubscriptionCount(): int;
}
