<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'event_date',
        'location',
        'type',
        'price',
        'currency',
        'image',
        'is_published',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'event_date' => 'datetime',
        'price' => 'decimal:2',
    ];
}
