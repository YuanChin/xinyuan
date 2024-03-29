<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Posts\CategoryController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\ReplyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::middleware(['auth'])
    ->group(function () {
        // About routes of the post
        Route::post('posts', [PostController::class, 'store'])
            ->name('posts.store');
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])
            ->name('posts.edit');
        Route::put('posts/{post}/publish', [PostController::class, 'publish'])
            ->name('posts.publish');
        Route::put('posts/{post}/unpublish', [PostController::class, 'unpublish'])
            ->name('posts.unpublish');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])
            ->name('posts.destroy');
        Route::post('posts/image/upload', [PostController::class, 'uploadImage'])
            ->name('posts.upload_image');
        Route::delete('posts/image/destroy', [PostController::class, 'deleteImage'])
            ->name('posts.delete_image');
        Route::post('posts/updated', [PostController::class, 'updated'])
            ->name('posts.updated');

        // About routes of the reply
        Route::post('replies', [ReplyController::class, 'store'])
            ->name('replies.store');
        Route::delete('replies/{reply}', [ReplyController::class, 'destroy'])
            ->name('replies.destroy');

        // About routes of the notification
        Route::get('notifications', [NotificationController::class, 'index'])
            ->name('notifications.index');
});


Route::get('/', [PostController::class, 'index'])
    ->name('root');
Route::get('posts', [PostController::class, 'index'])
    ->name('posts.index');
Route::get('posts/{post}/{slug?}', [PostController::class, 'show'])
    ->name('posts.show');
Route::get('categories/{postCategory}/{name?}', [CategoryController::class, 'show'])
    ->name('categories.show');
