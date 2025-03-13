<?php

namespace App\Exceptions;

use Exception;

class ShopDoesNotFoundException extends Exception
{
    public function __construct(int $shopId)
    {
        $message = "Id: [$shopId] doesn't found in the shop list";
        parent::__construct($message);
    }
}
