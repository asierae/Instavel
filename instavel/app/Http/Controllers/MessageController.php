<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Auth;
use App\Photo;
use App\User;
use App\Friend;
use App\Message;
use File;

class MessageController extends Controller
{
    //
      public function __construct()
    {
        $this->middleware('auth');
    }
  public function index(){
    $user=User::where('id',Auth::user()->id)->first();
    return view('profile.inbox')->with('user',$user)->with('error','0');
  }
  
    public function compose(){
    $user=User::where('id',Auth::user()->id)->first();
    return view('profile.compose')->with('user',$user)->with('error','0');
  }
  
  public function sendMessage(Request $request){
    $user=user::where('nickname',$request->receiver)->first();
    $cuantos=user::where('nickname',$request->receiver)->count();

    if($cuantos<1)
      return Response('El usuario no existe');
    $message=new Message;
    $message->tittle=$request->tittle;
    $message->message=$request->message;
    $message->author=Auth::user()->nickname;
    $message->receiver=$request->receiver;
    $user->messages()->save($message);
    
    return Response('Mensaje Enviado');
  }
  
  
}
