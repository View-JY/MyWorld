<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\User;

class CategoryKeep extends Model
{
  protected $table = 'category_keeps';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'category_id',
  ];

  // 与分类建立所属关系
  public function category()
  {
    return $this ->belongsTo(Category::class);
  }

  // 与用户建立所属关系
  public function user()
  {
    return $this ->belongsTo(User::class);
  }
}
