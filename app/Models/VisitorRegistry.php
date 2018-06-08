<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class VisitorRegistry extends Model
{
  protected $table = 'visitor_registry';

  protected $fillable = ['clicks'];

  public function visitors()
  {
    return $this->hasMany('App\VisitorRegistry');
  }

  public function article()
  {
      return $this->belongsTo(Article::class);
  }
}
