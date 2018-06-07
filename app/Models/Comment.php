<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Article;

class Comment extends Model
{
  protected $table = 'comments';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'article_id', 'body',
  ];

  // 与用户建立所属关系
  public function user()
  {
    return $this ->belongsTo(User::class);
  }

  // 与文章建立所属关系
  public function article()
  {
    return $this ->belongsTo(Article::class);
  }

  // 评论按时间排序
  public function scopeRecent($query, $time_orderBy = 'desc')
  {
      return $query->orderBy('created_at', $time_orderBy);
  }

  // 评论按时间排序
  public function scopeLook($query, $auth_id)
  {
      return $query->where('user_id', $auth_id);
  }

  // 与喜欢建立关联关系 (一对一)
  public function commentZan($user_id)
  {
    // 返回当前用户是否赞
    return $this ->hasOne(CommentZan::class) ->where('user_id', $user_id);
  }

  // 和文章进行关联（一对多）
  public function commentZans()
  {
      return $this ->hasMany(CommentZan::class);
  }
}
