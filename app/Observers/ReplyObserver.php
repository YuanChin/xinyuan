<?php

namespace App\Observers;

use App\Models\Reply;

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
}
