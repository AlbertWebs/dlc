<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    protected $fillable = [
        'type',
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public static function getPrivacyPolicy()
    {
        return static::where('type', 'privacy')->where('is_published', true)->first();
    }

    public static function getTermsOfService()
    {
        return static::where('type', 'terms')->where('is_published', true)->first();
    }
}
