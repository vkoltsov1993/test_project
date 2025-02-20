<?php

namespace App\Console\Commands\Test;

use App\Models\ProductUrl;
use Illuminate\Console\Command;

class SetPriceForProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product-set-price {--id=} {--price=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->option('id');
        $price = $this->option('price');

        $productUrl = ProductUrl::query()->find($id);

        if (!$productUrl){
            $this->info('Product not found');
            return;
        }
        $productUrl->update([
            'price' => $price
        ]);

        $this->info('New price is ' . $price);
    }
}
