<?php

namespace App\Services\Posts;

use App\Handlers\ImageHandler;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PostService
{
    /**
     * Store a PostCategory instance.
     *
     * @var PostCategory
     */
    protected $category;

    /**
     * Store a ImageHandler instance.
     *
     * @var ImageHandler
     */
    protected $imageHandler;

    public function __construct()
    {
        $this->category = new PostCategory();
        $this->imageHandler = new ImageHandler();
    }

    /**
     * Get all posts.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPublishedPosts(Request $request)
    {
        $post = new Post();

        $posts = $post
            ->published()
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'name', 'avatar');
                },
                'category' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->paginate(15);

        return $posts;
    }

    /**
     * Get the collection of PostCategory instance.
     *
     * @return mixed
     */
    public function getCategories()
    {
        return $this->category->getPostCategoryCollection();
    }

    /**
     * store a post to database.
     *
     * @return \App\Models\Post $post
     */
    public function storePostToDatabase()
    {
        $post = new Post();

        $post->user_id = Auth::id();
        $post->save();

        return $post;
    }

    /**
     * Temporarily save the post to Redis.
     *
     * @param Request $request
     * @return void
     */
    public function storePostToRedis(Request $request)
    {
        $post_id = $request->post_id;

        Redis::set('save_post:' . $post_id . '_user:' . Auth::id(), json_encode(
            [
                'title'            => $request->title,
                'post_category_id' => $request->post_category_id,
                'body'             => $request->body
            ], JSON_UNESCAPED_UNICODE)
        );
    }

    /**
     * Get the post from Redis.
     *
     * @param string $post_id
     * @return array|null
     */
    public function getPostFromRedis(string $post_id)
    {
        if (Redis::exists('save_post:' . $post_id . '_user:' . Auth::id())) {
            $data = json_decode(Redis::get('save_post:' . $post_id . '_user:' . Auth::id()), true);

            $data['post_category_id'] = (int) $data['post_category_id'];

            return $data;
        }

        return null;
    }

    /**
     * Delete the post from Redis
     *
     * @param string $post_id
     * @return void
     */
    public function deletePostFromRedis(string $post_id)
    {
        Redis::del('save_post:' . $post_id . '_user:' . Auth::id());
    }

    /**
     * Handle the uploaded image from the wangEditor editor.
     *
     * @param $file
     * @return array
     */
    public function handleUploadedImage($file)
    {
        $result = $this->imageHandler->setInformationOfTheUploadedImage(
            $file,
            (string)Auth::id(),
            'posts'
        )->save();

        return $result;
    }

    /**
     * Delete image.
     *
     * @param string $path
     * @return void
     */
    public function destroyUploadedImage(string $path)
    {
        $this->imageHandler->destroy($path);
    }
}