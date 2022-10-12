<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\Models\Post;
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

    /**
     * Display the specified resource
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, Post $post)
    {
        if (!empty($post->slug) && $post->slug != $request->slug) {
            return redirect($post->showLink(), 301);
        }

        return view("posts.show", [
            'post' => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $post = $this->service->storePostToDatabase();

        return redirect(route('posts.edit', $post->id));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = $this->service->getCategories();
        $data = $this->service->getPostFromRedis((string)$post->id);
        
        return view('posts.edit',[
            'categories' => $categories,
            'post'       => $post,
            'data'       => $data
        ]);
    }

    /**
     * Publish the specified resource in storage
     *
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function publish(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        
        $post->update(array_merge(
            ['is_published' => true],
            $request->all()
        ));

        $this->service->deletePostFromRedis((string)$post->id);

        return redirect($post->showLink())->with('success', '文章發布成功！');
    }

    /**
     * Unpublish the specified resource in storage
     *
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function unpublish(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update(array_merge(
            ['is_published' => false],
            $request->all()
        ));

        $this->service->deletePostFromRedis((string)$post->id);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return $this->success([], '文章刪除成功！');
    }

    /**
     * Handle the uploaded image from the wangEditor editor.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $result = $this->service->handleUploadedImage($request->file('upload_file'));

        if ($result['success']) {
            $data = [
                'url'  => $result['url']
            ];

            return $this->success($data, $result['message']);
        }

        return $this->fail([], $result['message']);
    }

    /**
     * Delete image.
     *
     * @param Request $request
     * @return void
     */
    public function deleteImage(Request $request)
    {
        $this->service->destroyUploadedImage($request->imagePath);
    }

    /**
     * When the form trigger a click event, the post will be automatically saved to Redis.
     *
     * @param Request $request
     * @return void
     */
    public function updated(Request $request)
    {
        if ($request->ajax()) {
            $this->service->storePostToRedis($request);
        }
    }
}
