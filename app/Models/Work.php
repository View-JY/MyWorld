<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\WorkTopic;

class Work extends Model
{
  protected $table = 'works';
  protected $primaryKey = 'id';

  protected $fillable = [
    'name', 'describe', 'user_id', 'cover'
  ];

  // 与用户监理所属关系
  public function user()
  {
    return $this ->belongsTo(User::class);
  }

  // 与文集建立关系
  public function workTopic()
  {
    return $this ->hasMany(WorkTopic::class);
  }
}
