<?php

namespace App\Services\ParsingService\ParsingStrategies;

use App\Exceptions\AmazonParseException;
use App\Exceptions\OlxParseException;
use Src\ParsingService\SimpleHtml;

class AmazonParsingStrategy extends ParsingStrategy
{
    private const string NAME_SELECTOR = '#productTitle';
    private const string PRICE_WHOLE_SELECTOR = '.a-price-whole';

    public function getProductName(): string
    {
        $node = $this->getNode()
            ->find(self::NAME_SELECTOR, 0);

        if (! $node) {
            $error = "Couldn't get product name or selector '" . self::NAME_SELECTOR . "' does not exist";
            throw new AmazonParseException($error, 404);
        }

        return $node->plaintext;
    }

    public function getProductPrice(): float
    {
        $nodePriceWhole = $this->getNode()
            ->find(self::PRICE_WHOLE_SELECTOR, 0);

        if ($nodePriceWhole) {
            $error = "Couldn't get product price or selector '" . self::PRICE_SELECTOR . "' does not exist";
            throw new OlxParseException($error, 404);
        }

        $price = preg_replace('/\D/', '', $node->plaintext);

        return $price;
    }

    /**
     * @return mixed
     * @throws AmazonParseException
     */
    private function getNode()
    {
        try {
            return SimpleHtml::getNode($this->url);
        } catch (\ErrorException) {
            throw new AmazonParseException('Url does not exist', 404);
        }
    }
}
