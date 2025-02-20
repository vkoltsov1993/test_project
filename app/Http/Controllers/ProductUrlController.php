<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductUrlResource;
use App\Models\ProductUrl;
use Illuminate\Http\Request;

class ProductUrlController extends Controller
{
    public function __invoke()
    {
        $productUrls = ProductUrl::all();

        return ProductUrlResource::collection($productUrls);
    }
}
