<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
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
}
