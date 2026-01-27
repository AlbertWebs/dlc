<?php

use App\Models\Navigation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('navigations')) {
            return;
        }

        // Remove duplicate navigation rows, keeping the first for each (location,label,url,category) combo
        Navigation::query()
            ->orderBy('location')
            ->orderBy('label')
            ->orderBy('url')
            ->orderBy('category')
            ->orderBy('id')
            ->get()
            ->groupBy(function (Navigation $nav) {
                return implode('|', [
                    $nav->location,
                    $nav->label,
                    $nav->url,
                    $nav->category ?? '',
                ]);
            })
            ->each(function ($group) {
                /** @var \Illuminate\Support\Collection $group */
                $keep = $group->shift(); // keep first
                // delete the rest
                $group->each->delete();
            });

        // Add a database-level unique index to prevent future duplicates
        Schema::table('navigations', function (Blueprint $table) {
            $table->unique(['location', 'label', 'url', 'category'], 'navigations_location_label_url_category_unique');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('navigations')) {
            return;
        }

        Schema::table('navigations', function (Blueprint $table) {
            if ($this->uniqueIndexExists('navigations', 'navigations_location_label_url_category_unique')) {
                $table->dropUnique('navigations_location_label_url_category_unique');
            }
        });
    }

    protected function uniqueIndexExists(string $table, string $index): bool
    {
        try {
            return Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableDetails($table)
                ->hasIndex($index);
        } catch (\Throwable $e) {
            return false;
        }
    }
};

