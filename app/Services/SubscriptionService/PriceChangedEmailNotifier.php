<?php

namespace App\Services\SubscriptionService;

use App\Dto\ProductUrlDto;
use App\Dto\UserDto;
use App\Mail\PriceChangedMail;
use Illuminate\Support\Facades\Mail;

class PriceChangedEmailNotifier implements Subscriber
{
    public function __construct(
        private readonly UserDto       $userDto,
        private readonly ProductUrlDto $productUrlDto,
        private readonly float         $newPrice
    )
    {

    }

    public function update(): void
    {
        $this->sendEmail($this->userDto->email);
    }

    private function sendEmail(string $email): void
    {
        Mail::to($email)
            ->send(new PriceChangedMail(
                $this->userDto, $this->productUrlDto, $this->newPrice
            ));
    }
}
