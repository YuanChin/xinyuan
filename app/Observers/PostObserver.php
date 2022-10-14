<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * 文章保存時觸發的事件
     *
     * @param Post $post
     * @return void
     */
    public function saving(Post $post)
    {
        // 防止XSS注入
        $post->body = clean($post->body);
    }
}
