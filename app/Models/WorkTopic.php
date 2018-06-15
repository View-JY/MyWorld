<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Work;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkTopic extends Model
{
  use SoftDeletes;

  protected $table = 'work_topics';
  protected $dates = ['deleted_at'];
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
