<?php

use App\Models\Navigation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('navigations')) {
            return;
        }

        // Add "Coaches" link just before "Become a Coach" if it's missing.
        $exists = Navigation::where('location', 'header')
            ->where('label', 'Coaches')
            ->orWhere(function ($q) {
                $q->where('location', 'header')->where('url', '/coaches');
            })
            ->exists();

        if ($exists) {
            return;
        }

        $become = Navigation::where('location', 'header')
            ->where('label', 'Become a Coach')
            ->orderBy('order')
            ->first();

        $insertOrder = $become?->order ?? 4;

        // Shift existing items down to make space.
        Navigation::where('location', 'header')
            ->where('order', '>=', $insertOrder)
            ->increment('order');

        Navigation::create([
            'label' => 'Coaches',
            'url' => '/coaches',
            'location' => 'header',
            'is_visible' => true,
            'order' => $insertOrder,
        ]);
    }

    public function down(): void
    {
        if (!Schema::hasTable('navigations')) {
            return;
        }

        Navigation::where('location', 'header')
            ->where(function ($q) {
                $q->where('label', 'Coaches')->orWhere('url', '/coaches');
            })
            ->delete();
    }
};

