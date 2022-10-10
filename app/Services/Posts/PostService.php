<?php

namespace App\Services\Posts;

use App\Models\Post;
use Illuminate\Http\Request;

class PostService
{
    /**
     * Get all posts.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPublishedPosts(Request $request)
    {
        $post = new Post();

        $posts = $post
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