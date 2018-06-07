<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\User;

class CommentZan extends Model
{
  protected $table = 'comment_zans';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'comment_id',
  ];

  // 与评论建立所属关系
  public function comment()
  {
    return $this ->belongsTo(Comment::class);
  }

  // 与用户建立所属关系
  public function user()
  {
    return $this ->belongsTo(User::class);
  }
}
