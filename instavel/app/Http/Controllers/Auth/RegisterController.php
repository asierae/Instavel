<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Mail;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
  
    public function showRegistrationForm()
    {
      return view('web.register');
    }
  
    protected $redirectTo = '/home/login';
    
    public function __construct()
    {
        $this->middleware('guest');
    }
  
    protected function register(Request $request)
    {
      
       //Instavel validators
       $messages = [
        'required'    => 'Rellenar el :attribute es obligatorio',
        'size'    => 'La longitud de :attribute tiene que ser: :size.',
        'unique' => 'Este :attribute ya se encuentra registrado',
        'in'      => 'El :attribute tiene que ser de uno de los siguientes tipos: :values',
        'confirmed' => 'El :attribute no coincide con su confirmación',
        'email' => 'El :attribute no es válido',
        'max' => 'Este :attribute es demasiado largo',
        'name.regex' => 'Debes introducir tu nombre (puedes incluir apellidos).',
        'password.regex' => 'La contraseña intrducida no es válida. Debe contener al menos: una mayúscula, una minúscula, un dígito y un carácter especial. Longitud entre 8 y 16 caracteres.',
        'nickname.regex' => 'El nick introducido no es válido. Solo puede contener números y letras. Longitud entre 9 y 20 caracteres.'
        ];
      
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:[([a-zA-Z]+)\s{0,1}([a-zA-Z]*)]',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|regex:[(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{8,16}]',
            'nickname' => 'required|unique:users|regex:[([a-zA-Z0-9]{4,25})]',
        ],$messages);
      
        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }  
      
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nickname' => $request->nickname,
            'role' => 'USER',
        ]);
      
        // Creamos su carpeta con su configuración
         if (!is_dir(public_path('/images/'. $request->nickname))) 
         {
              mkdir(public_path('/images/' . $request->nickname));
              copy(public_path('/img/avatar.jpg'),public_path('/images/'. $request->nickname.'/avatar.jpg'));
              copy(public_path('/images/img_perfil/photographer.jpg'),public_path('/images/'. $request->nickname.'/photographer.jpg'));
          }

        // Enviamos un email de bienvenida
         Mail::send('web.email-bienvenida', [], function($message) use ($request) 
         {
            $message->to($request->email, $request->nombre)
                    ->subject('Instavel: ¡Te damos la bienvenida!');
         });
      
        return view('web.mensaje')->with('msj',"¡Te has registrado! Haz clic <a href='/login'style='color: hotpink;'>aquí</a> para logearte");
    }
}
