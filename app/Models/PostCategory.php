<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostCategory extends Model
{
    use HasFactory;

    /**
     * ndicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'icon', 'name'
    ];

    /**
     * Reorganize the link to the category that will be shown.
     *
     * @return string
     */
    public function showLink()
    {
        return route('categories.show', [$this->id, $this->name]);
    }

    /**
     * If the category collection hits, the cached category collection will be returned. Otherwise, it will return from PostCategory instance.
     *
     * @return mixed
     */
    public function getPostCategoryCollection()
    {
        return Cache::remember("xinyuan_post_category_collection", (1440 * 60), function () {
            return $this->all();
        });
    }
}
