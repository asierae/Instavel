<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
  //Este override no funciona,vaya estafa
public function messages()
{
    return [
        'required'    => 'Rellenar el :attribute es obligatorio',
        'size'    => 'La longitud de :attribute must be exactly :size.',
        'auth.failed' => 'Usuario o Contraseña Incorrectas',
        'in'      => 'The :attribute must be one of the following types: :values',
    ];
}
  //Hacemos override de loginPost
  public function postLogin(Request $request){
        $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
    ]);

    $email=$request['email'];
    $password=$request['password'];
  
    if (Auth::attempt(['email' => $email, 'password' => $password, $request->has('remember')])) {
    // The user is active, not suspended, and exists.
      return view("home");
    }
    else if(Auth::attempt(['nickname' => $email, 'password' => $password, $request->has('remember')])){
       return view("home");
    }

    
    return view()->with("msjerror","credenciales incorrectas");

    }
          
    
  
  
}
