<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->boolean('is_from_google')->default(false)->after('is_active');
            $table->string('google_review_id')->nullable()->after('is_from_google');
            $table->timestamp('google_review_time')->nullable()->after('google_review_id');
            $table->integer('rating')->nullable()->after('google_review_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['is_from_google', 'google_review_id', 'google_review_time', 'rating']);
        });
    }
};
