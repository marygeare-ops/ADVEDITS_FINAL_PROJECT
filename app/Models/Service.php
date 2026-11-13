<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'event_type',
        'name',
        'service_type',
        'description',
        'price',
        'coverage_hours',
        'photographer_count',
        'videographer_count',
        'edited_photo_count',
        'video_duration',
        'inclusions',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'inclusions' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
