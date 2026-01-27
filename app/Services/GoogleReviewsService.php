<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Support\Carbon;

class GoogleReviewsService
{
    protected $apiKey;
    protected $placeId;

    public function __construct()
    {
        $this->apiKey = Setting::get('google_places_api_key', '');
        $this->placeId = Setting::get('google_place_id', '');
    }

    /**
     * Fetch reviews from Google Places API
     */
    public function fetchReviews()
    {
        if (empty($this->apiKey) || empty($this->placeId)) {
            Log::warning('Google Places API key or Place ID not configured');
            return null;
        }

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $this->placeId,
                'fields' => 'name,rating,user_ratings_total,reviews',
                'key' => $this->apiKey,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Check for API errors in response
                if (isset($data['status']) && $data['status'] !== 'OK') {
                    $errorMessage = $data['error_message'] ?? 'Unknown API error';
                    Log::error("Google Places API error status: {$data['status']} - {$errorMessage}");
                    return ['error' => $data['status'], 'message' => $errorMessage];
                }
                
                if (isset($data['result']['reviews'])) {
                    $reviews = $data['result']['reviews'];
                    Log::info("Fetched " . count($reviews) . " reviews from Google Places API");
                    return $reviews;
                }
                
                // Successful response but no reviews present
                Log::info("Google Places API returned successfully but no reviews found for Place ID: {$this->placeId}");
                return [];
            } else {
                $errorBody = $response->body();
                Log::error('Google Places API HTTP error: ' . $errorBody);
                return ['error' => 'HTTP_ERROR', 'message' => $errorBody];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching Google reviews: ' . $e->getMessage());
            return ['error' => 'EXCEPTION', 'message' => $e->getMessage()];
        }
    }

    /**
     * Sync Google reviews to testimonials table
     */
    public function syncReviews(bool $force = false)
    {
        // Enforce: at most 1 external API fetch per day (unless forced)
        if (!$force) {
            $lastSyncAtRaw = Setting::get('google_reviews_last_sync_at');
            if (!empty($lastSyncAtRaw)) {
                try {
                    $lastSyncAt = Carbon::parse($lastSyncAtRaw);
                    if ($lastSyncAt->isSameDay(now())) {
                        return [
                            'synced' => 0,
                            'skipped' => 0,
                            'total' => 0,
                            'cached' => true,
                            'message' => 'Skipped Google API fetch (already synced today).',
                        ];
                    }
                } catch (\Exception $e) {
                    // Ignore parse errors; we'll proceed to fetch.
                }
            }
        }

        $reviews = $this->fetchReviews();
        if ($reviews === null) {
            return [
                'synced' => 0,
                'skipped' => 0,
                'total' => 0,
                'cached' => false,
                'message' => 'Google API fetch failed or not configured.',
            ];
        }
        
        // Check if fetchReviews returned an error object
        if (is_array($reviews) && isset($reviews['error'])) {
            return [
                'synced' => 0,
                'skipped' => 0,
                'total' => 0,
                'cached' => false,
                'message' => 'Google API error: ' . ($reviews['message'] ?? $reviews['error']),
                'error_details' => $reviews['message'] ?? 'Unknown error',
            ];
        }

        $synced = 0;
        $skipped = 0;

        foreach ($reviews as $review) {
            // Check if review already exists by Google review ID
            $existing = Testimonial::where('google_review_id', $review['author_name'] . '_' . ($review['time'] ?? time()))
                ->first();

            $reviewId = ($review['author_name'] ?? 'Unknown') . '_' . ($review['time'] ?? time());
            $photoUrl = isset($review['profile_photo_url']) && !empty($review['profile_photo_url']) 
                ? $review['profile_photo_url'] 
                : null;

            if ($existing) {
                // Update existing review
                $existing->update([
                    'name' => $review['author_name'] ?? 'Anonymous',
                    'content' => $review['text'] ?? '',
                    'rating' => isset($review['rating']) ? (int)$review['rating'] : null,
                    'photo' => $photoUrl,
                    'google_review_id' => $reviewId,
                    'google_review_time' => isset($review['time']) ? date('Y-m-d H:i:s', $review['time']) : now(),
                    'google_review_payload' => $review,
                    'is_active' => true,
                ]);
                $synced++;
            } else {
                // Create new review
                Testimonial::create([
                    'name' => $review['author_name'] ?? 'Anonymous',
                    'content' => $review['text'] ?? '',
                    'rating' => isset($review['rating']) ? (int)$review['rating'] : null,
                    'photo' => $photoUrl,
                    'google_review_id' => $reviewId,
                    'google_review_time' => isset($review['time']) ? date('Y-m-d H:i:s', $review['time']) : now(),
                    'google_review_payload' => $review,
                    'is_from_google' => true,
                    'is_active' => true,
                    'order' => 0,
                ]);
                $synced++;
            }
        }

        // Record sync time only after a successful API call (even if 0 reviews).
        Setting::set('google_reviews_last_sync_at', now()->toDateTimeString());

        return [
            'synced' => $synced,
            'skipped' => $skipped,
            'total' => count($reviews),
            'cached' => false,
        ];
    }

    /**
     * Get Google Place details
     */
    public function getPlaceDetails()
    {
        if (empty($this->apiKey) || empty($this->placeId)) {
            return null;
        }

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $this->placeId,
                'fields' => 'name,rating,user_ratings_total,formatted_address,formatted_phone_number,website',
                'key' => $this->apiKey,
            ]);

            if ($response->successful()) {
                return $response->json()['result'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching place details: ' . $e->getMessage());
        }

        return null;
    }
}
