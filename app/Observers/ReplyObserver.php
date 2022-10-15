<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\PostReplied;

class ReplyObserver
{
    /**
     * 留言保存時觸發的事件
     *
     * @param Reply $reply
     * @return void
     */
    public function saving(Reply $reply)
    {
        // 防止XSS注入
        $reply->content = clean($reply->content);
    }

    /**
     * 回覆創建完後觸發的事件
     *
     * @param Reply $reply
     * @return void
     */
    public function created(Reply $reply)
    {
        if (!app()->runningInConsole()) {
            $reply->post->user->replyNotify(new PostReplied($reply));
        }
    }
}
