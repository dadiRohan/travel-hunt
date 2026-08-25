<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'travels';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'travel_date',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];

    /**
     * Get the user that created the travel.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the images for the travel.
     */
    public function images()
    {
        return $this->hasMany(TravelImage::class)->orderBy('order');
    }

    /**
     * Get the featured image (first image).
     */
    public function getFeaturedImageAttribute()
    {
        return $this->images()->first()?->image_path;
    }

    /**
     * Get the tags for the travel.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'travel_tag');
    }

    /**
     * Get all likes for the travel.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the count of likes.
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    /**
     * Get all comments for the travel.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the count of comments.
     */
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * Scope to get recent travels first.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope to filter by tag.
     */
    public function scopeByTag($query, $tagSlug)
    {
        return $query->whereHas('tags', function ($q) use ($tagSlug) {
            $q->where('slug', $tagSlug);
        });
    }

    /**
     * Scope to search travels.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('location', 'like', "%{$searchTerm}%");
    }
}
