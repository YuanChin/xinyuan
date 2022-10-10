<?php

namespace App\View\Components\Posts;

use App\Models\PostCategory;
use Illuminate\View\Component;

class Category extends Component
{
    /**
     * Store a PostCategory instance.
     *
     * @var App\Models\PostCategory
     */
    private $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->category = new PostCategory();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = $this->category->getPostCategoryCollection();
        
        return view('components.posts.category', [
            'categories' => $categories
        ]);
    }
}
