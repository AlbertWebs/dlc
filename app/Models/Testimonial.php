<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'company',
        'content',
        'photo',
        'order',
        'is_featured',
        'is_active',
        'is_from_google',
        'google_review_id',
        'google_review_time',
        'rating',
        'google_review_payload',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_from_google' => 'boolean',
        'google_review_time' => 'datetime',
        'rating' => 'integer',
        'google_review_payload' => 'array',
    ];
}
