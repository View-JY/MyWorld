<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
  protected $table = 'followers';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id', 'follow_id',
  ];
}
