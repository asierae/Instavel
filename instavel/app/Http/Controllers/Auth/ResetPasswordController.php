<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        return view('web.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
  
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? view('web.mensaje')->with('msj',"Se ha restablecido la contraseña con éxito.")
                    : view('web.mensaje')->with('msj',"Ha habido algún error. Inténtalo de nuevo.");
      
      
    }
  
    protected function rules()
    {
        return [
            'token' => 'required', 'email' => 'required|email',
            'password' => 'required|confirmed|regex:[(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{8,16}]',
        ];
    }
  
    
    protected function validationErrorMessages()
    {
        return [
                  'required'    => 'Rellenar el :attribute es obligatorio',
                  'confirmed' => 'El :attribute no coincide con su confirmación',
                  'email' => 'El :attribute no es válido',
                  'token' => 'Asegúrate de haber recibido un E-Mail para restablecer tu contraseña. Si no, vuelve a solicitarlo.',
                  'password.regex' => 'La contraseña intrducida no es válida. Debe contener al menos: una mayúscula, una minúscula, un dígito y un carácter especial. Longitud entre 8 y 16 caracteres.',
                ];
    }

}
