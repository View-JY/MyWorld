<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Category extends Model
{
    // 关联文章（一对多关联关系）
    public function article()
    {
      return $this ->hasMany(Article::class);
    }
}
