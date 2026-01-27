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
                
                if (isset($data['result']['reviews'])) {
                    return $data['result']['reviews'];
                }
                
                // Successful response but no reviews present
                return [];
            } else {
                Log::error('Google Places API error: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error fetching Google reviews: ' . $e->getMessage());
        }

        return null;
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
