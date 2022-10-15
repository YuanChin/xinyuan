<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class PostReplied extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Store a notified Reply insatnce.
     *
     * @var Reply
     */
    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        $post = $this->reply->post;

        return [
            'reply_id'      => $this->reply->id,
            'reply_content' => $this->reply->content,
            'user_id'       => $this->reply->user->id,
            'user_name'     => $this->reply->user->name,
            'user_avatar'   => $this->reply->user->avatar,
            'post_link'     => $post->showLink(),
            'post_title'    => $post->title,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'notification_count' => $notifiable->notification_count
        ]);
    }

}
