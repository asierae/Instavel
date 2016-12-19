@extends('web.home')

@section('content')

<div class="bgimg-1 w3-display-container w3-opacity-min" id="register">
    <br><br>
    <!--main-->
    <div class="main-agileits">
        <h2 class="sub-head">Restablece tu contraseña:</h2>
        <div class="sub-main">
            <form role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                
                <input type="hidden" name="token" value="{{ $token }}">
              
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" id="email" class="mail"  placeholder="ejemplo@host.com" required>
                    <span class="icon3"><i class="fa fa-envelope" aria-hidden="true"></i></span><br>
                    @if ($errors->has('email'))
                      <span style="color: white; font-family: 'Lato'; font-size: 17px; font-style: normal;">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span><br><br>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" placeholder="Contraseña" name="password" id="password" class="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$@$!%*#?&]).{8,16}" title="Debe contener al menos: una mayúscula, una minúscula, un dígito y un carácter especial. Longitud entre 8 y 16 caracteres" required>
                    <span class="icon4"><i class="fa fa-unlock" aria-hidden="true"></i></span><br>
                    @if ($errors->has('password'))
                      <span style="color: white; font-family: 'Lato'; font-size: 17px; font-style: normal;">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span><br><br>
                    @endif
                </div>
                <input  placeholder="Confirma tu contraseña" name="password_confirmation" id="password_confirmation" class="pass" type="password" required>
                <span class="icon5"><i class="fa fa-unlock" aria-hidden="true"></i></span><br>

                <input type="submit" value="Restablecer">
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <!--//main-->
    <br><br>
</div>


@endsection

