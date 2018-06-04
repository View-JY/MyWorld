<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCollect extends Model
{
  protected $table = 'article_collects';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'article_id',
  ];

  // 与文章建立所属关系
  public function article()
  {
    return $this ->belongsTo(Article::class);
  }

  // 与用户建立所属关系
  public function user()
  {
    return $this ->belongsTo(User::class);
  }
}
