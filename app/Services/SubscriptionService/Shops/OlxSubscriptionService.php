<?php

namespace App\Services\SubscriptionService\Shops;

use App\Dto\ProductUrlDto;
use App\Enums\Shop;
use App\Models\ProductUrl;
use App\Services\ParsingService\ParsingService;
use App\Services\ParsingService\ParsingStrategies\OlxParsingStrategy;
use App\Services\SubscriptionService\SubscriptionService;

class OlxSubscriptionService extends SubscriptionService
{
    private readonly ParsingService $parsingService;

    public function getProductWithUpdatedPrice(string $url): ProductUrlDto
    {
        $this->parsingService = new ParsingService(new OlxParsingStrategy($url));
        $productName = $this->parsingService->getProductName();
        $productPrice = $this->parsingService->getProductPrice();

        return $this->productUrlRepository->updateOrCreate(
            [
                'url' => $url,
                'shop' => Shop::Olx
            ],
            [
                'name' => $productName,
                'price' => $productPrice,
            ]);
    }
}
