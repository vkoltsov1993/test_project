<?php

namespace App\Services\ParsingService\ParsingStrategies;

require_once "simple_html_dom.php";

use App\Exceptions\OlxParseException;
use function App\Services\ParsingService\file_get_html;

class OlxParsingStrategy extends ParsingStrategy
{

    private const string NAME_SELECTOR = '.css-yde3oc';
    private const string PRICE_SELECTOR = '.css-fqcbii';

    public function getProductName(): string
    {
        $node = $this->getNode()
            ->find(self::NAME_SELECTOR, 0);

        if (! $node) {
            $error = "Couldn't get product name or selector '" . self::NAME_SELECTOR . "' does not exist";
            throw new OlxParseException($error, 404);
        }

        return $node->plaintext;
    }

    public function getProductPrice(): float
    {
        $node = $this->getNode()
            ->find(self::PRICE_SELECTOR, 0);

        if (! $node) {
            $error = "Couldn't get product price or selector '" . self::PRICE_SELECTOR . "' does not exist";
            throw new OlxParseException($error, 404);
        }

        $price = preg_replace('/\D/', '', $node->plaintext);

        return $price;
    }

    /**
     * @return mixed
     * @throws OlxParseException
     */
    private function getNode()
    {
        try {
            return file_get_html($this->url);
        } catch (\ErrorException) {
            throw new OlxParseException('Url does not exist', 404);
        }
    }
}
