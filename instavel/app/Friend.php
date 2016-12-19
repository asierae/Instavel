<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    //
      protected $fillable = [
        'id', 'nickname',
    ];
public function user()
  {
    return $this->belongsTo('App\User');
  }
}
