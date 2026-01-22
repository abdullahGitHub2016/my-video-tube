<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
protected $fillable = [
    'user_id',
    'title',
    'description',
    'video_path',
    'thumbnail_path',
    'views'
];

    /**
     * The attributes that should be appended to the model's array form.
     * These help the Vue components get clean data without extra logic.
     */
    protected $appends = [
        'created_at_human',
        'thumbnail_url',
        'video_url'
    ];

    /**
     * RELATIONSHIP: A video belongs to a user (the creator).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ACCESSOR: Format the date for the Vue frontend (e.g., "2 days ago").
     */
    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * ACCESSOR: Get the full URL for the thumbnail.
     * This handles both seeded URLs and locally stored paths.
     */
    public function getThumbnailUrlAttribute()
    {
        if (str_starts_with($this->thumbnail_path, 'http')) {
            return $this->thumbnail_path;
        }
        return asset('storage/' . $this->thumbnail_path);
    }

    /**
     * ACCESSOR: Get the full URL for the video file.
     */
    public function getVideoUrlAttribute()
    {
        if (str_starts_with($this->video_path, 'http')) {
            return $this->video_path;
        }
        return asset('storage/' . $this->video_path);
    }
}
