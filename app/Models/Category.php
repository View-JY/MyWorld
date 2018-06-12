<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\CategoryKeep;
use App\User;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'cover',
    ];

    // 关联文章（一对多关联关系）
    public function article()
    {
      return $this ->hasMany(Article::class);
    }

    // 与关注建立关联关系 (一对一)
    public function categoryKeep($user_id)
    {
      // 返回当前用户是否关注
      return $this ->hasOne(CategoryKeep::class) ->where('user_id', $user_id);
    }

    // 和文章进行关联（一对多）
    public function categoryKeeps()
    {
        return $this ->hasMany(CategoryKeep::class);
    }

    // 与用户建立所属关系
    public function user()
    {
        return $this ->belongsTo(User::class);
    }
}
