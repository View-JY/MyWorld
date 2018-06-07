<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Work;

class WorkTopic extends Model
{
  protected $table = 'work_topics';
  protected $primaryKey = 'id';
  protected $fillable = [
    'name', 'body', 'cover', 'user_id', 'work_id',
  ];

  // 与文集建立所属关系
  public function work()
  {
    return $this ->belongsTo(Work::class);
  }
}
