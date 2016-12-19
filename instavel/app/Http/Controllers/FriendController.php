<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Photo;
use App\User;
use App\Friend;
use File;
use Mail;

class FriendController extends Controller
{
    //
  
    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
  public function addFriend($nickname)
  {
      //Comprobamos que existe
      $existe=User::where('nickname',$nickname)->first();
      if(sizeof($existe)<1)
      {
        return view('profile.misfriends')->with('msj','Este usuario no existe,Amigos imaginarios?')->with('error','0');
      }
      //Comprobamos que no soy yo
      if($nickname==Auth::user()->nickname)
      {
        return view('profile.misfriends')->with('msj','No puedes seguir a tu alter ego')->with('error','0');
      }
      $user = User::find(Auth::user()->id);
      //comprobar que no le sigo ya
      foreach($user->friends()->get() as $friend) 
      {      
        if($friend->nickname==$nickname)
        {
           return view('profile.misfriends')->with('msj',"Ya sigues a este Usuariio")->with('error','0');
        }
     
      }
    
      $friend = new Friend;
      $friend->nickname = $nickname;
      $user->friends()->save($friend);
    
      $data= array('nickname' => $nickname,'email'=>$existe->email,'nombre'=>$existe->name);
             Mail::send('web.email-nuevofriend',$data , function($message)  use ($data) 
      {
            $message->to($data['email'], $data['nombre'])
                   
                    ->subject('Instavel: Te sigue un nuevo usuario');
                    
       });
      $existe->followers=$existe->followers+1;
      $existe->save();
      $msj='newfriend';
      //return Response('Has comenzado a seguirle!');
      return view('profile.misfriends')->with('msj',$msj)->with('newfriend',$nickname)->with('error','0');
  }
  
  public function deleteFriend($nickname)
  {
      
       $user = User::find(Auth::user()->id);
      //comprobar que no le sigo ya
      foreach($user->friends()->get() as $friend){
      
        if($friend->nickname==$nickname){
           $friend->delete();
        }
     
      }
      $myunfriend=User::where('nickname',$nickname)->first();
      $myunfriend->followers=$myunfriend->followers-1;
      $myunfriend->save();
      return Response("Ya no sigues a ".$nickname);
    
  }
  
  public function getFriends()
  {
     $user=User::where('id',Auth::user()->id)->first();
     return view('profile.misfriends')->with('user',$user)->with('msj','normal')->with('error','0');
  }
  
  public function getUserFriends($nickname)
  {
    $user=User::where('nickname',$nickname)->get();
    return view('profile.friends')->with('user',$user)->with('msj','normal')->with('error','0');
  }
  
  public function getFriendsNews()
  {
     $user = User::find(Auth::user()->id);
     $myfriendphotosall=Photo::where('author','xxx')->get();
    
      //comprobar que no le sigo ya
      foreach($user->friends()->get() as $friend)
      {
        $myfriendphotos=Photo::where('author',$friend->nickname)->orderBy('updated_at','desc')->take(3)->get();
        //return $myfriendphotos;
        $myfriendphotosall->add(collect($myfriendphotos));

      }
      
     // return $myfriendphotosall;
     //dd($myfriendphotosall->toArray());
     return view('photos.news')->with('photos',$myfriendphotosall->sortBy('updated_at'))->with('error','0');
  }
  
}
