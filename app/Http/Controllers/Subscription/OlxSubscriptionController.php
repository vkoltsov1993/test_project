<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductUrlResource;
use App\Services\SubscriptionService\SubscriptionService;
use Illuminate\Http\Request;

class OlxSubscriptionController extends Controller
{
    public function __invoke(SubscriptionService $subscriptionService, Request $request)
    {
        $email = $request->input('email');
        $url = $request->input('url');

        $productUrl = $subscriptionService->subscribe($url, $email);

        return new ProductUrlResource($productUrl);
    }
}
