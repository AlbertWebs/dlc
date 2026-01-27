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
        
        // Check configuration first
        $apiKey = \App\Models\Setting::get('google_places_api_key', '');
        $placeId = \App\Models\Setting::get('google_place_id', '');
        
        if (empty($apiKey)) {
            $this->error('❌ Google Places API Key is not configured.');
            $this->info('Please set it in Admin → Settings → Google Reviews Integration');
            return Command::FAILURE;
        }
        
        if (empty($placeId)) {
            $this->error('❌ Google Place ID is not configured.');
            $this->info('Please set it in Admin → Settings → Google Reviews Integration');
            return Command::FAILURE;
        }
        
        $this->info("✓ API Key configured: " . substr($apiKey, 0, 10) . '...');
        $this->info("✓ Place ID configured: " . $placeId);
        
        $result = $service->syncReviews((bool)$this->option('force'));

        if (!empty($result['cached'])) {
            $this->info($result['message'] ?? 'Skipped (cached).');
            $this->info('Use --force flag to force a fresh sync.');
            return Command::SUCCESS;
        }

        if (!empty($result['message']) && $result['synced'] === 0 && ($result['total'] ?? 0) === 0) {
            $this->error('❌ ' . $result['message']);
            if (isset($result['error_details'])) {
                $this->error('Details: ' . $result['error_details']);
            }
            $this->info('');
            $this->info('Troubleshooting:');
            $this->info('1. Verify your API key is valid and has Places API enabled');
            $this->info('2. Check that your Place ID is correct');
            $this->info('3. Ensure your Google Business Profile has reviews');
            $this->info('4. Check Laravel logs for detailed error messages');
            return Command::FAILURE;
        }

        if (($result['synced'] ?? 0) > 0) {
            $this->info("✓ Successfully synced {$result['synced']} reviews.");
        } else {
            $this->warn('⚠ No reviews were synced.');
        }

        $this->info("Total reviews fetched from Google: " . ($result['total'] ?? 0));
        
        if (($result['total'] ?? 0) === 0) {
            $this->warn('');
            $this->warn('Possible reasons:');
            $this->warn('- Your Google Business Profile has no reviews yet');
            $this->warn('- The Place ID might be incorrect');
            $this->warn('- API restrictions might be blocking the request');
            $this->info('');
            $this->info('Check Laravel logs for more details: storage/logs/laravel.log');
        }
        
        return Command::SUCCESS;
    }
}
