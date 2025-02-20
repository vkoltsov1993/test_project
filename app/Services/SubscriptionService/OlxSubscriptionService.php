<?php

namespace App\Services\SubscriptionService;

use App\Enums\ProductUrlShop;
use App\Models\ProductUrl;
use App\Services\ParsingService\ParsingService;
use App\Services\ParsingService\ParsingStrategies\OlxParsingStrategy;

class OlxSubscriptionService extends SubscriptionService
{
    private readonly ParsingService $parsingService;

    public function getProductUrl(string $url): ProductUrl
    {
        $this->parsingService = new ParsingService(new OlxParsingStrategy($url));
        $productName = $this->parsingService->getProductName();
        $productPrice = $this->parsingService->getProductPrice();

        return ProductUrl::query()
            ->updateOrCreate(
                [
                    'url' => $url,
                    'shop' => ProductUrlShop::Olx
                ],
                [
                    'name' => $productName,
                    'price' => $productPrice,
                ]);
    }
}
