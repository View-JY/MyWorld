<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'user_id', 'cover', 'abstract'];

    // 与文章分类建立所属关系
    public function category()
    {
      return $this ->belongsTo(Category::class);
    }
}
