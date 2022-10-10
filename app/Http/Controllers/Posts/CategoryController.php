<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Services\Posts\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Store a CategoryService instance.
     *
     * @var CategoryService
     */
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display the specified resource
     *
     * @param Request $request
     * @param PostCategory $postCategory
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, PostCategory $postCategory)
    {
        if ($postCategory->name != $request->name) {
            return redirect($postCategory->showLink(), 301);
        }

        $posts = $this->service->getPostsByCategory($request, $postCategory);
  
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
}
