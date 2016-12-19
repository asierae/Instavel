<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APIKey extends Model
{
    //
  
     protected $fillable = [
        'id', 'nickname', 'key', 'active', 'hits',
    ];
}
