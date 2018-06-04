<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Comment;

class TopicReplied extends Notification
{
    use Queueable;

    public $comment;

    public function __construct(Comment $comment)
    {
        // 注入回复实体，方便 toDatabase 方法中的使用
        $this ->comment = $comment;
    }

    public function via($notifiable)
    {
        // 开启通知的频道
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $article = $this ->comment ->article;
        $link =  $article->link(['#reply' . $this ->comment ->id]);

        // 存入数据库里的数据
        return [
            'reply_id' => $this->comment->id,
            'reply_content' => $this->comment->content,
            'user_id' => $this->comment->user->id,
            'user_name' => $this->comment->user->name,
            'user_avatar' => $this->comment->user->avatar,
            'topic_link' => $link,
            'topic_id' => $article->id,
            'topic_title' => $article->title,
        ];
    }
}
