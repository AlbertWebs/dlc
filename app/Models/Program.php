<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'content',
        'icon',
        'image',
        'price',
        'currency',
        'features',
        'meta',
        'is_published',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'features' => 'array',
        'meta' => 'array',
        'price' => 'decimal:2',
    ];
}
