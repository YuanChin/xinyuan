<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
  
        return view('posts.index');
    }
}
