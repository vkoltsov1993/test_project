<?php

namespace App\Services\ParsingService;

use App\Models\ProductUrl;
use App\Services\ParsingService\ParsingStrategies\ParsingStrategy;


class ParsingService
{
    public function __construct(
        private readonly ParsingStrategy $parsingStrategy
    )
    {
    }

    public function getProductName(): string
    {
        return $this->parsingStrategy->getProductName();
    }

    public function getProductPrice(): float
    {
        return $this->parsingStrategy->getProductPrice();
    }
}
