<?php

namespace App\Services\Posts;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class CategoryService
{
    /**
     * Get all posts by category name.
     *
     * @param Request $request
     * @param PostCategory $postCategory
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPostsByCategory(Request $request, PostCategory $postCategory)
    {
        $posts = $postCategory->posts()
            ->published()
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'name', 'avatar');
                },
                'category' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->paginate(15);
        
        return $posts;
    }
}