<?php

namespace App\Services\ParsingService\ParsingStrategies;

abstract class ParsingStrategy
{
    public function __construct(protected readonly string $url)
    {
    }

    abstract public function getProductName(): string;

    abstract public function getProductPrice(): float;
}
