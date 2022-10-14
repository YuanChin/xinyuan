<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\ReplyRequest;
use App\Models\Reply;
use App\Services\Posts\ReplyService;

class ReplyController extends Controller
{
    /**
     * Store a ReplyService instance.
     *
     * @var ReplyService
     */
    protected $service;

    public function __construct(ReplyService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReplyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReplyRequest $request)
    {
        if ($request->ajax()) {
            $this->service->storeReplyToDatabase($request);

            return $this->success([], '留言成功！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        
        $reply->delete();

        return $this->success([], '留言刪除成功！');
    }
}
