<?php

namespace App\Services\SubscriptionService;

use App\Mail\PriceChangedMail;
use App\Models\ProductUrl;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PriceChangedEmailNotifier implements Subscriber
{
    public function __construct(
        private readonly User       $user,
        private readonly ProductUrl $productUrl,
        private readonly float $newPrice
    )
    {

    }

    public function update(): void
    {
        $this->sendEmail($this->user->email);
    }

    private function sendEmail(string $email): void
    {
        Mail::to($email)
            ->send(new PriceChangedMail(
                $this->user, $this->productUrl, $this->newPrice
            ));
    }
}
