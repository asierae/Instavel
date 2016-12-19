<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Auth;
use App\Photo;
use App\User;
use App\Friend;
use File;


class ProfileController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showPerfil()
    {

       $photos = Photo::where('id_user',Auth::user()->id)->orderBy('created_at', 'desc')->get();
          return view('profile.miperfilfotos')->with('error','0')->with('photos',$photos);
    }
  
    public function getPerfil($user)
    {
        //Comprobar si es privado
        $u=User::where('nickname',$user)->first();
        $follow=false;
      
      $me=User::where('id',Auth::user()->id)->first();
          //Comprobar si le seguimos
           foreach($me->friends()->get() as $friend)
           {
              if($friend->nickname==$user)
              {          
                $follow=true;
              }
            }
        //return $u->tipocuenta;
        if($u->tipocuenta=='private')
        {
          //sino le seguimos devolvemos mensaje de seguirle o nothing
          if(!$follow)
          {
            return view('profile.miperfil')->with('error','o Perfil Privado, Sigue al usuario para poder ver sus fotos <a href="/addfriend/'.$user.'">Seguir</a>');//Devolver mejor una view nueva de content con el error
          }
        }
        //sino le mostramos el perfil
        $req=User::where('nickname',$user)->get();
        if(sizeof($req)<1)
          return view('profile.miperfil')->with('error',$user);//Devolver mejor una view nueva de content con el error
        
      $ufollow=false;
      //Comprobar si el nos sigue, es decir si es amigo nuestro
          foreach($u->friends()->get() as $ufriend)
           {
              if($ufriend->nickname==Auth::user()->nickname)
              {          
                $ufollow=true;
              }
            }
        //si no nos sigue solo las fotos públicas
        if(!$ufollow)
        $photos = Photo::where('id_user',$req[0]->id)->where('mode','public')->orderBy('created_at', 'desc')->get();//Cogemos solo las publicas,en /perfil cogemos todas las de Authuser
        else//Si nos sigue, nos enseña tambien las de onlyfriends
        $photos = Photo::where('id_user',$req[0]->id)->where('mode','public')->orwhere('mode','onlyfriends')->orderBy('created_at', 'desc')->get();
       
      
      return view('profile.perfilfotos')->with('photos',$photos)->with('error','0')->with('user',$req);//Como envia la vista desde resources, no tiene el css, hay que añadir lo de {{Url(ruta/elcess.css)}} o copiarlo todo en los dos
    }
  
  
    public function getInfo()
    {
      $user=User::where('id',Auth::user()->id)->get();
      return view('profile.miinfo')->with('user',$user)->with('error','0');
    }
  
    public function getInfoUser($user)
    {
      $userinfo=User::where('nickname',$user)->get();
       $follow=false;
      $me=User::where('id',Auth::user()->id)->first();
          //Comprobar si le seguimos
           foreach($me->friends()->get() as $friend)
           {
              if($friend->nickname==$user)
              {          
                $follow=true;
              }
            }

      return view('profile.info')->with('user',$userinfo)->with('follow',$follow)->with('error','0');
    }
  
  
    public function updateInfo(Request $request)
    {
      if($request->op=="texto")
      {
          //  $image = $request->file('file');
         //  $image->move(public_path('/images/' . Auth::user()->nickname),'avatar.jpg');
          
          $myself=User::where('id',Auth::user()->id)->first();
          $myself->name=$request->name;
          $myself->cita=$request->cita;
          $myself->aboutme=$request->aboutme;
          $myself->city=$request->city;
          $myself->tipocuenta=$request->tipocuenta;
          
          if (!($request->password == "")) // Si la contraseña no está en blanco la validamos
          {
            $validator_password = Validator::make($request->all(), 
              ['password' => 'confirmed|regex:[(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{8,16}]',] ,
              ['password.regex' => 'La contraseña intrducida no es válida. Debe contener al menos: una mayúscula, una minúscula, un dígito y un carácter especial. Longitud entre 8 y 16 caracteres.',]
            );
            
            if ($validator_password->fails()) // Si el validador falla devolvemos un mensaje de error
            {
              return Response('La contraseña introducida no es válida o te has confundido al confirmarla.');
            }
            
            // Si todo ha ido bien incluimos la contraseña nueva (encriptada) para guardarla
            $myself->password=bcrypt($request->password);
          }
        
          if(!($request->name == "")) // Si el nombre no está vacío lo validamos
          {
            // Comprobamos la validez del nombre recibido...
            $validator_name = Validator::make($request->all(), 
              ['name' => 'regex:[([a-zA-Z]+)\s{0,1}([a-zA-Z]*)]',] ,
              ['name.regex' => 'Debes introducir un nombre válido (letras del alfabeto).',]
            );

            // Si no es válido devolvemos un mensaje de error.
            if ($validator_name->fails())
            {
              return Response('Debes introducir un nombre válido (letras del alfabeto).');
            }
          }
          else // Si el nombre está vacío devolvemos un mensaje de error
          {
            return Response('No puedes dejar el nombre en blanco.');
          }
        
          $myself->save();
          return Response('¡Perfil Actualizado!');
      }
      else if($request->op=="imagen") {//en dos veces obligado!
           $image = $request->file;
          //$image = $request->file('file');
          $nombre=$request->photoname;
          File::delete(public_path('/images/' . Auth::user()->nickname).'/avatar.jpg');
          //File::move();
          $image->move(public_path('/images/' . Auth::user()->nickname),'avatar.jpg');
          return Response('Avatar Cambiado!');
      }
         else if($request->op=="fondo")
         {
           $image = $request->file;
          //$image = $request->file('file');
          $nombre=$request->photoname;
          File::delete(public_path('/images/' . Auth::user()->nickname).'/photographer.jpg');
          //File::move();
          $image->move(public_path('/images/' . Auth::user()->nickname),'photographer.jpg');
          return Response('Fondo Cambiado!');
          }
        return Response('Ummm...');
    }
  
    public function getSearchResult(Request $request)
    {
     
      $users=User::where('mode','public')->where('nickname','LIKE','%'.$request->nickname.'%')->get();
      $output='';
      foreach($users as $user){
        $output.='<table class="table table-bordered table-hover"><tr>'.
                  "<td><img src='/images/'.$users->nickname.'/avatar.jpg' width='250px'></td>".
                  '<td><a href="perfil/'.$user->nickname.'">Perfil de'.$user->nickname.'</a></td>'.
                  '<td>'.$user->name.'</td>'.
                  '<td>Usuario desde'.$user->created_at.'</td>'.
          '</tr></table>';
                         
    }
      return Response($output);
  }
  
    
  
}
