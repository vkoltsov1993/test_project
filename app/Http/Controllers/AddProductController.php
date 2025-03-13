<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService\SubscriptionService;
use Illuminate\Http\Request;

class AddProductController extends Controller
{
    public function __invoke(SubscriptionService $subscriptionService)
    {
        $email = request()->input('email');
        $url = request()->input('url');
        $subscriptionService->subscribe($url, $email);
    }
}
