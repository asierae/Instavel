<?php

namespace App;

use App\Notifications\MyResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'email', 'password', 'avatar','role', 'cita', 'aboutme', 'city', 'tipocuenta', 'created_at','followers',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
  
    public function friends()
    {
        return $this->hasMany('App\Friend');
    }
      public function messages()
    {
        return $this->hasMany('App\Message');
    }
  
  
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }
}
