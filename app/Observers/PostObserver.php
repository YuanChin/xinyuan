<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
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

    /**
     * 文章更新後觸發的事件
     *
     * @param Post $post
     * @return void
     */
    public function updated(Post $post)
    {
        // 佇列處理翻譯SLUG
        if (!app()->runningInConsole()) {
            if (!$post->slug) {
                dispatch(new TranslateSlug($post));
            }
        }
    }
}
