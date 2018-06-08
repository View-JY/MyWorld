<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Tag extends Model
{
  protected $table='tags';
  protected $primaryKey = 'id';
  protected $fillable = ['tag_name', 'article_number'];

  /**
   * 文章与标签多对多关联
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function article()
  {
      return $this->belongsToMany(Article::class, 'article_tags', 'tag_id', 'article_id');
  }
}
