<?php

namespace App\Services\Posts;

use App\Http\Requests\Posts\ReplyRequest;
use App\Models\Reply;

class ReplyService
{
    public function storeReplyToDatabase(ReplyRequest $request)
    {
        $reply = new Reply();

        $reply->content = $request->content;
        $reply->post_id = $request->post_id;
        $reply->user_id = $request->user_id;
        $reply->save();

        return $reply;
    }
}