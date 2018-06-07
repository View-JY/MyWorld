<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
  protected $table = 'helps';
  protected $primaryKey = 'id';
  protected $fillable = [
    'content', 'contact',
  ];
}
