<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'category',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        // Remove the old uploaded image when a record is deleted.
        static::deleted(function (Gallery $gallery) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
        });

        // Remove the previous image when it is replaced.
        static::updated(function (Gallery $gallery) {
            if ($gallery->wasChanged('image')) {
                $oldImage = $gallery->getOriginal('image');

                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
