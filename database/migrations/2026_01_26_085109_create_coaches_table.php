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
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title')->nullable(); // e.g., "Certified Life Coach"
            $table->text('bio')->nullable();
            $table->text('description')->nullable(); // Full description using CKEditor
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->json('credentials')->nullable(); // Array of credentials
            $table->json('specializations')->nullable(); // Array of specializations
            $table->json('social_links')->nullable(); // Social media links
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->text('certifications')->nullable();
            $table->text('coaching_style')->nullable();
            $table->text('testimonials')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
