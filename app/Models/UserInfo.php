<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserInfo extends Model
{
  protected $table = 'user_infos';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'sex', 'avatar', 'introduction', 'url',
  ];

  // 与用户建立所属关系
  public function user()
  {
    return $this ->belongsTo(User::class);
  }
}
