<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\User;
use App\Comment;
use Auth;

class PhotoController extends Controller
{
    //
        public function __construct()
    {
        $this->middleware('auth');
    }
  
  
  public function likePhoto($idphoto){
      $photo = Photo::where('id',$idphoto)->first();
      $photo->likes=($photo->likes)+1;
      $photo->save();
    return $photo->likes;
  }
  
  public function getTopPhotos(Request $request){
    $photo = Photo::where('id',$request->idphoto)-get();
  }
  
    public function getSearchView(){
      
      return view('profile.search')->with('error','0');
    }
  
  public function getSearchResult(Request $request){
      if($request->op=='images'){
      
      $photos=Photo::where('mode','public')->where('tags','LIKE','%'.$request->tag.'%')->orwhere('tittle','LIKE','%'.$request->tag.'%')->get();
      $output='';
    foreach($photos as $photo){
      $output.='<table><tr>'.
                '<td><a href="perfil/'.$photo->author.'">'.$photo->author.'</a></td>'.
                '<td>'.$photo->tittle.'</td>'.
                '<td><img src='.$photo->path." width='250px'></td>".
                 '<td><a href="view/'.$photo->id.'">Ver Más</a></td>'.
        '</tr></table>';
                
              
    }
      }
    else if($request->op=='users'){
            $users=User::where('nickname','LIKE','%'.$request->nickname.'%')->orwhere('name','LIKE','%'.$request->nickname.'%')->get();
      $output='';

    foreach($users as $user){
      $output.='<table><tr>'.
                '<td>'.$user->nickname.' /'.$user->name.'</td>'.
                '<td><img src="/images/'.$user->nickname.'/avatar.jpg" width="250px"></td>'.
                '<td> <a href="/addfriend/'.$user->nickname.'" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Seguir</a>'.
                '<br><br><a href="/perfil/'.$user->nickname.'" class="btn btn-success">Ver Perfil<span class="glyphicon glyphicon-ok-user"></span></a>'.
                '</td></tr></table>';
               }
    }
      return Response($output);
  }
  
  public function getPhoto($idphoto){
        $photo = Photo::where('id',$idphoto)->first();
        if($photo->mode=='private' && Auth::user()->id!=$photo->id_user){
           return "Esa foto es privada";
        }
       if(sizeof($photo)<1){
         return "Esa foto te la acabas de inventar";
       }
    
        if(Auth::user()->id==$photo->id_user){
          
         return view('photos.miphoto')->with('photo',$photo)->with('error','0'); 
        }
    else{
    return view('photos.photo')->with('photo',$photo)->with('error','0'); ;
    }
  }
  
  
    public function editPhoto(Request $request){
 
       if(Auth::user()->id!=$request->id_user){
        return Response('Estas hecho un hacker');
       }
        $photo = Photo::where('id',$request->idphoto)->first();
        $photo->tittle=$request->tittle;
        $photo->description=$request->description;
        $photo->tags=$request->tags;
        $photo->mode=$request->mode;
        $photo->save();
    return Response('Publicación actualizada!');
      
  }
  public function deletePhoto($idphoto){
   
      $tmp=Photo::where('id',$idphoto)->first();
      if(sizeof($tmp)<1){
        return "Te has perdido";
      }
     if(Auth::user()->id!=$tmp->id_user){
        return "ya te vale";
       }
    $deletedRows = Photo::where('id', $idphoto)->delete();
    //devuelve 1 si borrada
    //y las conservamos en nuestro servidor como whatsapp,sólo el admin podra borrar la carpeta
    $photos=Photo::where('id_user',Auth::user()->id)->first();
    return redirect('/perfil');
    return view('profile.miperfilfotos')->with('msj','Foto Borrada.')->with('error','0')->with('photos',$photos);
    
  }

  
  
  
}
