<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CommentObserver
{
    // 信息提示
    public function created(Comment $comment)
    {
        $article = $comment->article;
        $article->increment('info_count', 1);

        // 通知作者话题被回复了
        $article->user->notify(new TopicReplied($comment));
    }

    public function saving(Comment $comment)
    {
        $comment ->article ->increment('comment_count', 1);
    }

    public function deleting(Comment $comment)
    {
        $comment ->article ->decrement('comment_count', 1);
    }

    public function creating(Comment $comment)
    {
      // XSS攻击
      // $comment ->body = clean($reply->body, 'user_topic_body');
    }
}
