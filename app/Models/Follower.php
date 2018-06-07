<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follower extends Model
{
  protected $table = 'followers';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'follow_id',
  ];

  protected function user()
  {
    return $this ->belongsTo(User::class);
  }
}
