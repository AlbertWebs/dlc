<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleReviewsService;

class SyncGoogleReviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google-reviews:sync {--force : Force a fresh Google API fetch even if already synced today}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Google Reviews to testimonials table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Google Reviews sync...');

        $service = new GoogleReviewsService();
        $result = $service->syncReviews((bool)$this->option('force'));

        if (!empty($result['cached'])) {
            $this->info($result['message'] ?? 'Skipped (cached).');
            return Command::SUCCESS;
        }

        if (!empty($result['message']) && $result['synced'] === 0 && ($result['total'] ?? 0) === 0) {
            $this->warn($result['message']);
            return Command::FAILURE;
        }

        if (($result['synced'] ?? 0) > 0) {
            $this->info("Successfully synced {$result['synced']} reviews.");
        } else {
            $this->warn('No reviews were synced.');
        }

        $this->info("Total reviews fetched: " . ($result['total'] ?? 0));
        
        return Command::SUCCESS;
    }
}
