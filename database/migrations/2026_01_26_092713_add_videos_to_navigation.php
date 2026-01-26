<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Navigation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add Videos to header navigation if it doesn't exist
        $headerVideos = Navigation::where('location', 'header')
            ->where('label', 'Videos')
            ->first();
        
        if (!$headerVideos) {
            Navigation::create([
                'label' => 'Videos',
                'url' => '/videos',
                'location' => 'header',
                'is_visible' => true,
                'order' => 5,
            ]);
        }

        // Update Contact order in header to 6
        Navigation::where('location', 'header')
            ->where('label', 'Contact')
            ->update(['order' => 6]);

        // Update order of items after Contact in header
        Navigation::where('location', 'header')
            ->where('label', 'Life Mastery Bootcamp')
            ->update(['order' => 7]);
        
        Navigation::where('location', 'header')
            ->where('label', 'Life Mastery Webinar')
            ->update(['order' => 8]);
        
        Navigation::where('location', 'header')
            ->where('label', 'My Account')
            ->update(['order' => 9]);

        // Add Videos to footer navigation if it doesn't exist
        $footerVideos = Navigation::where('location', 'footer')
            ->where('label', 'Videos')
            ->where('category', 'quick_links')
            ->first();
        
        if (!$footerVideos) {
            Navigation::create([
                'label' => 'Videos',
                'url' => '/videos',
                'location' => 'footer',
                'category' => 'quick_links',
                'is_visible' => true,
                'order' => 5,
            ]);
        }

        // Update Contact order in footer to 6
        Navigation::where('location', 'footer')
            ->where('label', 'Contact')
            ->where('category', 'quick_links')
            ->update(['order' => 6]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove Videos from header
        Navigation::where('location', 'header')
            ->where('label', 'Videos')
            ->delete();

        // Restore Contact order in header to 5
        Navigation::where('location', 'header')
            ->where('label', 'Contact')
            ->update(['order' => 5]);

        // Restore order of items after Contact in header
        Navigation::where('location', 'header')
            ->where('label', 'Life Mastery Bootcamp')
            ->update(['order' => 6]);
        
        Navigation::where('location', 'header')
            ->where('label', 'Life Mastery Webinar')
            ->update(['order' => 7]);
        
        Navigation::where('location', 'header')
            ->where('label', 'My Account')
            ->update(['order' => 8]);

        // Remove Videos from footer
        Navigation::where('location', 'footer')
            ->where('label', 'Videos')
            ->where('category', 'quick_links')
            ->delete();

        // Restore Contact order in footer to 5
        Navigation::where('location', 'footer')
            ->where('label', 'Contact')
            ->where('category', 'quick_links')
            ->update(['order' => 5]);
    }
};
