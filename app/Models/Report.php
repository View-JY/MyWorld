<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Report extends Model
{
  protected $table = 'reports';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'comment_id',
  ];

  // 与用户建立所属关系
  public function user()
  {
    return $this ->belongsTo(User::class);
  }
}
