<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\Posts\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Store a PostService instance.
     *
     * @var PostService
     */
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $posts = $this->service->getPublishedPosts($request);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Display the specified resource
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, Post $post)
    {
        if (!empty($post->slug) && $post->slug != $request->slug) {
            return redirect($post->showLink(), 301);
        }

        return view("posts.show", [
            'post' => $post
        ]);
    }
}
