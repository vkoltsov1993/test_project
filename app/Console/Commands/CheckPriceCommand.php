<?php

namespace App\Console\Commands;

use App\Services\CheckPriceService\CheckPriceService;
use Illuminate\Console\Command;

class CheckPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command checks if price changed';

    /**
     * Execute the console command.
     */
    public function handle(CheckPriceService $checkPriceService)
    {
        $checkPriceService->run();
        $this->info('Checking product price process has been started.');
    }
}
