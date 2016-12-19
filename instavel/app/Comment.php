<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_photo', 'comment', 'author',
    ];
  
  
      public function photo()
  {
    return $this->belongsTo('App\Photo');
  }
}
