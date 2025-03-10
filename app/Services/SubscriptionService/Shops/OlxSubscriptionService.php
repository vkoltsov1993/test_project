<?php

namespace App\Services\SubscriptionService\Shops;

use App\Enums\Shop;
use App\Models\ProductUrl;
use App\Services\ParsingService\ParsingService;
use App\Services\ParsingService\ParsingStrategies\OlxParsingStrategy;
use App\Services\SubscriptionService\SubscriptionService;

class OlxSubscriptionService extends SubscriptionService
{
    private readonly ParsingService $parsingService;

    public function getNewProductPrice(string $url): float
    {
        $this->parsingService = new ParsingService(new OlxParsingStrategy($url));
        $productName = $this->parsingService->getProductName();
        $productPrice = $this->parsingService->getProductPrice();

        $productUrlDto = $this->productUrlRepository->updateOrCreate(
            [
                'url' => $url,
                'shop' => Shop::Olx
            ],
            [
                'name' => $productName,
                'price' => $productPrice,
            ]);

        return $productUrlDto->price;
    }
}
