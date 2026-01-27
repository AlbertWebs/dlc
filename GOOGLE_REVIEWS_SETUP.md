# Google Reviews Integration Setup Guide

This guide will help you set up Google Reviews streaming for your testimonials section.

## Features

- ✅ Automatically fetch reviews from Google Business Profile
- ✅ Sync reviews to your testimonials database
- ✅ Display Google reviews with a badge on your website
- ✅ Show star ratings from Google reviews
- ✅ Automatic photo handling (Google profile photos)

## Setup Instructions

### Step 1: Get Google Places API Key

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable the **Places API**:
   - Navigate to "APIs & Services" > "Library"
   - Search for "Places API"
   - Click "Enable"

4. Create an API Key:
   - Go to "APIs & Services" > "Credentials"
   - Click "Create Credentials" > "API Key"
   - Copy your API key

5. **Important**: Restrict your API key:
   - Click on your API key to edit it
   - Under "API restrictions", select "Restrict key"
   - Choose "Places API" only
   - Save changes

### Step 2: Find Your Google Place ID

1. Go to [Google Place ID Finder](https://developers.google.com/maps/documentation/places/web-service/place-id)
2. Search for your business name
3. Copy the Place ID (it looks like: `ChIJN1t_tDeuEmsRUsoyG83frY4`)

Alternatively, you can find it by:
- Going to your Google Business Profile
- Looking at the URL: `https://www.google.com/maps/place/YOUR_BUSINESS_NAME/@LAT,LONG,DATA`
- The Place ID is in the URL or you can use Google's Place ID Finder tool

### Step 3: Configure in Admin Panel

1. Log in to your admin panel: `http://localhost:8000/admin`
2. Go to **Settings** (in the sidebar under "Settings" group)
3. Scroll down to **"Google Reviews Integration"** section
4. Enter your:
   - **Google Places API Key**
   - **Google Place ID**
5. Click **"Save All Settings"**

### Step 4: Sync Google Reviews

Run the sync command to fetch reviews from Google:

```bash
php artisan google-reviews:sync
```

This will:
- Fetch all reviews from your Google Business Profile
- Create new testimonials for reviews that don't exist
- Update existing reviews if they've changed
- Mark them as Google reviews (`is_from_google = true`)

### Step 5: Schedule Automatic Sync (Optional)

To automatically sync reviews daily, add this to your `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('google-reviews:sync')->daily();
}
```

Then set up a cron job:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## How It Works

1. **GoogleReviewsService** (`app/Services/GoogleReviewsService.php`):
   - Fetches reviews from Google Places API
   - Handles API authentication and errors
   - Maps Google review data to your testimonials structure

2. **Database Fields**:
   - `is_from_google`: Boolean flag indicating Google review
   - `google_review_id`: Unique identifier for the review
   - `google_review_time`: When the review was posted
   - `rating`: Star rating (1-5)

3. **Display**:
   - Google reviews show a blue "Google" badge
   - Star ratings are displayed
   - Profile photos from Google are used
   - Reviews appear alongside manual testimonials

## Display Locations

Google reviews automatically appear in:
- Homepage testimonials section
- Videos page testimonials section
- Coach profile page testimonials section

## Troubleshooting

### "No reviews were synced"
- Check that your API key is correct
- Verify your Place ID is correct
- Ensure Places API is enabled in Google Cloud Console
- Check Laravel logs: `storage/logs/laravel.log`

### "API key not configured"
- Make sure you've saved the API key in Settings
- Verify the settings were saved correctly

### Reviews not showing
- Ensure reviews are marked as `is_active = true`
- Check that reviews exist in your Google Business Profile
- Verify the sync command ran successfully

## API Costs

Google Places API has a free tier:
- **$200 free credit per month** (equivalent to ~40,000 requests)
- After free tier: $0.017 per request
- Reviews are fetched once per sync, so costs are minimal

## Security Notes

- **Never commit your API key to version control**
- Store API keys in `.env` file (already configured)
- Restrict your API key to only Places API
- Consider adding IP restrictions for additional security

## Support

For issues or questions:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Verify API key and Place ID are correct
3. Test API connection using Google's API Explorer
4. Check that your Google Business Profile has reviews
