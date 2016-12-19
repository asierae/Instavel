<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
     // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'author', 'path', 'tittle', 'photoname', 'likes', 'tags', 'description','mode',//mode=public,friends,private
    ];
  
   public function comments()
  {
    return $this->hasMany('App\Comment');
  }

}
