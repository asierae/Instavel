<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Session;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Photo;
use App\User;
use App\Friend;
use App\Comment;
use File;
use App\Subscriber;
use Mail;
use DB;
use App\APIKey;

class AdminController extends Controller
{
    //
      use AuthenticatesUsers;

  
  public function index(){
    if(!Auth::guest()){
			if(Auth::user()->role=='ADMIN')
      return redirect('/admin/panel');
			else
				return redirect('/home');
		}
    return view('vendor.adminlte.auth.login')->with('msj', '');
  }
    public function panel(){
    $users=User::where('role','USER')->get()->count();
		$photos=Photo::all()->count();
		$subs=Subscriber::all()->count();
		$coms=Comment::all()->count();
		$mostfollowed=User::orderBy('followers','desc')->first();
		$mostliked=Photo::orderBy('likes','desc')->first();
		$data=array($users,$photos,$subs,$coms,$mostfollowed,$mostliked);
			
    return view('vendor.adminlte.home')->with('data',$data);
  }
  
	
	  public function newsletter(){
    if(Auth::guest())
      return redirect('/admin');
    return view('vendor.adminlte.newsletter');
  }
	
	public function addSub(Request $request){

			$tmp=Subscriber::where('email',$request->email)->get();
			if($tmp->count()>0)
				return Response('Usuario ya suscrito');
			$sub=new Subscriber;
			$sub->email=$request->email;
			$sub->save();
		
		return Response('Te has suscrito al NewsLetter!');
	}
	
   protected function login(Request $request)
    {
      $messages = ['required' => 'Rellenar el :attribute es obligatorio'];
      
      $validator = Validator::make($request->all(), [
        'nickname' => 'required',
        'password' => 'required',
      ], $messages); 
      
      if ($validator->fails()) {
            return redirect('admin')
                        ->withErrors($validator)
                        ->withInput();
      }  
      
      $credentials = $request->only('nickname', 'password');
			
      //vemos si es admin
      $valido=User::where('nickname',$request->nickname)->first();
			if(!isset($valido))
				return view('vendor.adminlte.auth.login')->with('msj',"Credenciales incorrectas.");
			
			if($valido->count()<1)
				return view('vendor.adminlte.auth.login')->with('msj',"Credenciales incorrectas.");
			
      if($valido->role!='ADMIN')
         return view('vendor.adminlte.auth.login')->with('msj',"Credenciales incorrectas.");
      
      //si lo es intentamos loguearnos
      if (Auth::attempt($credentials, $request->has('remember')))
      {
          return redirect('/admin/panel');
      }
   
      return view('vendor.adminlte.auth.login')->with('msj',"Credenciales incorrectas.");

    }
  
  
   public function deleteUser($nickname){
   		if(Auth::user()->role!='ADMIN'){
					return 'Baia Baia';
			}
      $tmp=User::where('nickname',$nickname)->first();
      if(sizeof($tmp)<1){
        return "No existe tal usuario";
      }
		if($tmp->role=='ADMIN'){
			return "No puedes borrar un Administrador";
		}
    $deletedRows = User::where('nickname',$nickname)->delete();
    //devuelve 1 si borrada
		//la carpeta es solo File->delete, pero nosotros nos la guardamos
    return view('vendor.adminlte.users')->with('msj','Usuario '.$nickname.' Eliminado.');
    
  }
  
	
	public function sendNewsletter(Request $request){
		$subs=Subscriber::all();	
		foreach($subs as $sub){
			
			   $data= array('email' => $sub->email,'tittle'=>$request->tittle,'mensaje'=>$request->msj);
             Mail::send('web.email-newsletter',$data , function($message)  use ($data) 
         {
            $message->to($data['email'], 'AdminInstavel')
                   
                    ->subject($data['tittle']);
                    
         });
			
		}
		return Response('NewsLetter enviado a todos los suscriptores');
	}
	
	
	
  public function search(Request $request){

      if($request->op=='images'){
      $photos=Photo::where('tags','LIKE','%'.$request->tag.'%')->orwhere('photoname','LIKE','%'.$request->tag.'%')->get();
      $output='';
    foreach($photos as $photo){
      $output.='<table class="table table-bordered table-hover"><tr>'.
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
      /*$output.='<table class="table table-bordered table-hover"><tr>'.
                '<td>'.$user->nickname.' /'.$user->name.'</td>'.
                '<td><img src="/images/'.$user->nickname.'/avatar.jpg" width="250px"></td>'.
                 '<td> <a href="/addfriend/'.$user->nickname.'" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Seguir</a>'.
                 '<br><br><a href="/perfil/'.$user->nickname.'" class="btn btn-success">Ver Perfil<span class="glyphicon glyphicon-ok-user"></span>  </a></td></tr></table>';
              */
      
 $output.='     <br>
<div class="container-fluid well span6">
	<div class="column-fluid">
        <div class="span2" >
		    <img src="/images/'.$user->nickname.'/avatar.jpg" width="150px" class="img-circle">
        </div>
        
        <div class="span8">
            <h3>Usuario '.$user->nickname.'</h3>
            <h6>Email:'.$user->email.'</h6>
            <h6>Ubicación: '.$user->city.'</h6>
            <h6>Creado: '.$user->created_at.'</h6>
            <h6><a href="/admin/panel/edit/'.$user->nickname.'">Ver más... </a></h6>
        </div>
        
        <div class="span2">
            <div class="btn-group">
                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                    Action 
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/panel/edit/'.$user->nickname.'"><span class="icon-wrench"></span> Sus Fotos</a></li>
                    <li><a href="/admin/panel/delete/'.$user->nickname.'"><span class="icon-trash"></span> Borrar</a></li>
                </ul>
            </div>
        </div>
</div>
</div>';
       }
    }
      return Response($output);
  }
	
	public function editAlbum($nickname){
		$photos=Photo::where('author',$nickname)->orderBy('created_at', 'desc')->get();
		if($photos->count()<1){
				return view('vendor.adminlte.editalbum')->with('msj','El usuario no tiene fotos');
		}
		return view('vendor.adminlte.editalbum')->with('photos',$photos);
	}
  
  public function deletePhoto(Request $request){
		$photo=Photo::where('id',$request->id)->first();
		if($photo->count()<1){
			return Response('Esa foto no existe');
		}
		else{
			$photo->delete();
		}
			
			return Response('La foto '.$request->id.' ha sido borrada');
	}

	
	public function showUsers(){
			$users=User::where('role','USER')->orderBy('created_at', 'desc')->paginate(10);
			$cuantos=User::where('role','USER')->get()->count();
		return view('vendor.adminlte.users')->with('users',$users)->with('cuantos',$cuantos);
	}
	public function addKey(Request $request){
		$user=User::where('nickname',$request->user)->get();
		if($user->count()<1)
			return Response('<strong>Usuario no registrado</strong>');
		$key=APIKey::where('key',$request->key)->get();
		if($key->count()>0)
			return Response('<strong>Key ya asignada</strong>');
		$newkey=new APIKey;
		$newkey->nickname=$request->user;
		$newkey->key=$request->key;
		$newkey->active='true';
		$newkey->hits=$request->hits;
		$newkey->save();
		$user=User::where('nickname',$request->user)->first();
		
		$data= array('email' => $user->email,'tittle'=> 'API Key Activa','mensaje'=>'Tu API Key: '.$request->key.' Ya se ecnuentra activa,disfrutala');
             Mail::send('web.email-newsletter',$data , function($message)  use ($data) 
         {
            $message->to($data['email'], 'AdminInstavel')
                   
                    ->subject($data['tittle']);
                    
         });
		
		return Response('<strong>Generada y activada APIKey</strong>');
	}
	public function showApi(){
		$num=APIKey::where('active','true')->count();
		return view('vendor.adminlte.api')->with('numkeys',$num);
	}
	public function getAPIRequest($key,$tag,$n){
			
			$valid=APIKey::where('key',$key)->count();


			if($valid<1)
					return response()->json(['status' => 'error','msj' => 'Invalid Key.']);
		
				$userkey=APIKey::where('key',$key)->first();
				if($userkey->hits<1){
					return response()->json(['status' => 'error','msj' => 'Limite de peticiones alcanzado, Recarga peticiones :).']);
				}
				$photos=Photo::where('tags','LIKE','%'.$tag.'%')->where('mode','public')->take($n)->get();
				//Hit!
				
				if($userkey->hits>0){
				$userkey->hits=$userkey->hits-1;
				$userkey->save();
				}
		
				if($photos->count()==0)
					return response()->json(['status' => 'error','msj' => 'No hay fotos sobre esos tags disponibles']);
			//	return $photos;
					return response()->json($photos);
	}
		public function getAPIPostRequest(Request $request){
			 
    $image = $request->file('file');
    $description=$request->description;
    $tags=$request->tags;
    $mode=$request->mode;
    $tittle=$request->tittle;
        $imageName = time().'|'.Input::file('file')->getClientOriginalName();

        $image->move(public_path('/images/' . Auth::user()->nickname),$imageName);
			$nick=APIKey::where('key',$request->key)->first();
      $username=User::where('nickname',$nick->nickname)->first();
             
        //Guardamos en DB
        $photo=new Photo;
        $photo->id_user=$username->id;
        $photo->path=/*public_path() .*/'/images/' . Auth::user()->nickname.'/'.$imageName;
        $photo->photoname=$image->getClientOriginalName();
        $photo->likes=0;
        $photo->description=$description;
        $photo->mode=$mode;
        $photo->tags=$tags;
        $photo->tittle=$tittle;
        $photo->author=$username->nickname;
      
        $res=$photo->save();

       
        //return $photo->save();
        return response()->json(['success'=>'Imagen '.$imageName.' publicada']);
		
		}
}
