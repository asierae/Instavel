<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\User;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    //
          public function __construct()
    {
        $this->middleware('auth');
    }
  
   public function addComment(Request $request){
      $photo=Photo::where('id',$request->id)->first();
    
      $comment = new Comment;
      $comment->author = $request->author;
      $comment->comment=$request->comment;
      $photo->comments()->save($comment);

    return Response('Comentario Añadido');
  }
  
   public function deleteComment(Request $request){
        $comment=Comment::where('id',$request->id)->delete();

          return Response("Comentario Borrado");
        }
    
  
  
   public function getPhotoComments($photoid){
     $photo=Photo::where('id',$photoid)->get();
    if($photo->author!=Auth::user()->nickname)
        return view('photos.phoho')->with('photo',$photo)->with('msj','normal')->with('error','0');
     else
    return view('photos.miphoho')->with('photo',$photo)->with('msj','normal')->with('error','0');
  }
  

  
  
}
