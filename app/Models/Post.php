<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'post_category_id',
        'title',
        'body',
        'is_published',
        'excerpt',
        'slug'
    ];

    /**
     * Reorganize the link to the post that will be shown.
     *
     * @return string
     */
    public function showLink()
    {
        return route('posts.show', [$this->id, $this->slug]);
    }

    /**
     * Get the user that owns this post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns this post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    /**
     * Get the replies that belong to the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Select the posts have been published.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Select the posts haven't been published.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }
}
