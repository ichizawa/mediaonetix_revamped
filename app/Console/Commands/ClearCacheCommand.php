<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClearCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-cache-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clearing all application caches';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('optimize:clear');
        $this->info('System optimized successfully.');

        return self::SUCCESS;
    }
}
