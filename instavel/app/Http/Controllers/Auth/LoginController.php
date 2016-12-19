<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Session;

use Illuminate\Contracts\Auth\Guard;

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

    public function showLoginForm()
    {
        return view('web.login')->with('msj', '');
    }

    protected $redirectTo = '/perfil';//. Auth::user()->nickname;
  
    protected $loginpath = '/home/login';

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'logout']);
    }
  
    protected function login(Request $request)
    {
      $messages = ['required' => 'Rellenar el :attribute es obligatorio'];
      
      $validator = Validator::make($request->all(), [
        'nickname' => 'required',
        'password' => 'required',
      ], $messages); 
      
      if ($validator->fails()) {
            return redirect('home/login')
                        ->withErrors($validator)
                        ->withInput();
      }  
      
      $credentials = $request->only('nickname', 'password');

      if ($this->auth->attempt($credentials, $request->has('remember')))
      {
          return redirect('/perfil');
      }
   
      return view('web.login')->with('msj',"Credenciales incorrectas.");

    }
  
    protected function logout()
    {
        $this->auth->logout();

        Session::flush();

        return view('web.mensaje')->with('msj',"Vuelve pronto. Te estaremos esperando.");
    }
}
