<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'title',
        'bio',
        'description',
        'photo',
        'email',
        'phone',
        'location',
        'credentials',
        'specializations',
        'social_links',
        'experience',
        'education',
        'certifications',
        'coaching_style',
        'testimonials',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'credentials' => 'array',
        'specializations' => 'array',
        'social_links' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Generate slug from name
     */
    public static function generateSlug($name)
    {
        $slug = Str::slug($name);
        $count = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }
        return $slug;
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
