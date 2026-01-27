<?php

use App\Models\Navigation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('navigations')) {
            return;
        }

        // More aggressive deduplication: remove duplicates based on location, label, url, and category
        // Keep the one with the lowest ID for each unique combination
        $duplicates = DB::select("
            SELECT location, label, url, COALESCE(category, '') as category, MIN(id) as keep_id
            FROM navigations
            WHERE is_visible = 1
            GROUP BY location, label, url, COALESCE(category, '')
            HAVING COUNT(*) > 1
        ");

        foreach ($duplicates as $dup) {
            // Delete all except the one with the lowest ID
            Navigation::where('location', $dup->location)
                ->where('label', $dup->label)
                ->where('url', $dup->url)
                ->whereRaw("COALESCE(category, '') = ?", [$dup->category])
                ->where('id', '!=', $dup->keep_id)
                ->delete();
        }

        // Also ensure we don't have duplicates with different visibility settings
        // Keep visible ones over hidden ones
        $visibleDuplicates = DB::select("
            SELECT location, label, url, COALESCE(category, '') as category
            FROM navigations
            GROUP BY location, label, url, COALESCE(category, '')
            HAVING COUNT(*) > 1
        ");

        foreach ($visibleDuplicates as $dup) {
            $items = Navigation::where('location', $dup->location)
                ->where('label', $dup->label)
                ->where('url', $dup->url)
                ->whereRaw("COALESCE(category, '') = ?", [$dup->category])
                ->orderBy('is_visible', 'desc') // visible first
                ->orderBy('id')
                ->get();

            if ($items->count() > 1) {
                // Keep the first (visible, lowest ID), delete the rest
                $items->skip(1)->each->delete();
            }
        }
    }

    public function down(): void
    {
        // No rollback needed for data cleanup
    }
};
