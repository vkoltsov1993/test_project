<?php

namespace App\Services\SubscriptionService;

class ProductPublisher implements Publisher
{
    /**
     * @var Subscriber[]
     */
    private array $subscribers = [];

    public function attach(Subscriber $subscriber): void
    {
        $this->subscribers[] = $subscriber;
    }

    public function detach(Subscriber $subscriber): void
    {
        $key = array_search($subscriber, $this->subscribers);
        array_splice($this->subscribers, $key, 1);
    }

    public function notify(): void
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->update();
        }
    }

    public function getSubscriptionCount(): int
    {
        return count($this->subscribers);
    }
}
