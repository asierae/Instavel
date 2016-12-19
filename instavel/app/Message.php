<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
      protected $fillable = [
        'id', 'author', 'receiver', 'tittle','message',
    ];
  
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
