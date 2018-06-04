<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\User;
use App\Models\ArticleZan;
use App\Models\ArticleCollect;
use App\Models\Comment;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'cover', 'abstract'];

    // 与文章分类建立所属关系
    public function category()
    {
      return $this ->belongsTo(Category::class);
    }

    // 与用户建立所属关系
    public function user()
    {
      return $this ->belongsTo(User::class);
    }

    // 与喜欢建立关联关系 (一对一)
    public function articleZan($user_id)
    {
      // 返回当前用户是否赞
      return $this ->hasOne(ArticleZan::class) ->where('user_id', $user_id);
    }

    // 和文章进行关联（一对多）
    public function articleZans()
    {
        return $this ->hasMany(ArticleZan::class);
    }

    // 与收藏建立关联关系 (一对一)
    public function articleCollect($user_id)
    {
      // 返回当前用户是否赞
      return $this ->hasOne(ArticleCollect::class) ->where('user_id', $user_id);
    }

    // 和收藏进行关联（一对多）
    public function articleCollects()
    {
        return $this ->hasMany(ArticleCollect::class);
    }

    // 与回复建立关联(一对多)
    public function comment()
    {
      return $this ->hasMany(Comment::class);
    }

    public function link($params = [])
    {
      return route('articles.show', array_merge([$this->id,  $this->slug], $params));
    }
}
