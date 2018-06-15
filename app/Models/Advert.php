<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table = 'adverts';
    protected $fillable = [
      'name', 'cover', 'link', 'weight'
    ];
}
