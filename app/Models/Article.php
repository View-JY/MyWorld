<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\User;
use App\Models\ArticleZan;
use App\Models\ArticleCollect;
use App\Models\Comment;
use App\Models\VisitorRegistry;
use App\Models\ArticleTag;
use App\Models\Tag;
use App\Models\Collect;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'cover', 'abstract', 'status'];

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
        return $this ->hasMany(ArticleZan::class, 'article_id', 'id') ->orderBy('created_at', 'desc');
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
        return $this ->hasMany(ArticleCollect::class, 'article_id', 'id');
    }

    // 与回复建立关联(一对多)
    public function comment()
    {
      return $this ->hasMany(Comment::class) ->orderBy('created_at', 'desc');
    }

    public function link($params = [])
    {
      return route('articles.show', array_merge([$this->id,  $this->slug], $params));
    }

    public function visitors()
    {
        return $this->hasMany(VisitorRegistry::class);
    }

    /**
     * 文章标签
     * Article tags
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleTag()
    {
        return $this->hasMany(ArticleTag::class, 'article_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }

    // 状态
    protected static function boot()
    {
      parent::boot();

      static::addGlobalScope('avaiable', function( $builder ){
        $builder ->whereIn('status', ['0', '1']);
      });
    }

    public function collect()
    {
        return $this->hasMany(Collect::class);
    }
}
