<?php

namespace App\Console\Commands;

use App\Jobs\RefreshCacheProductJob;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FreshCache extends Command
{
    public $productRepository;
    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        parent::__construct();
        $this->productRepository = $productRepositoryInterface;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh cache product';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        RefreshCacheProductJob::dispatch($this->productRepository);
        return 0;
    }
}
