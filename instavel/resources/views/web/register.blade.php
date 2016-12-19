@extends('web.home')

@section('content')
<!-- Container (Register Section) -->
<div class="bgimg-1 w3-display-container w3-opacity-min" id="register">
    <br><br>
    <!--header-->
    <div class="header-w3l">
        <h1>Bienvenido a Instavel</h1>
    </div>
    <!--//header-->
    <!--main-->
    <div class="main-agileits">
        <h2 class="sub-head">Regístrate aquí</h2>
        <div class="sub-main">
            <form role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              
                
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" id="name" name="name" class="name2" placeholder="Nombre"  pattern="([a-zA-Z]+)\s{0,1}([a-zA-Z]*)" title="Debes introducir tu nombre (puedes incluir apellidos)" required>
                      <span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span><br>
                      @if ($errors->has('name'))
                        <span style="color: white; font-family: 'Lato'; font-size: 17px; font-style: normal;">
                          <strong>{{ $errors->first('name') }}</strong>
                        </span><br><br>
                      @endif
                </div>
                <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                    <input type="text"id="nickname" name="nickname" class="number" placeholder="Nick" pattern="([a-zA-Z0-9]{4,25})" title="Tu nick solo puede contener números y letras. Longitud entre 9 y 20 caracteres"required>
                    <span class="icon2"><i class="fa fa-user" aria-hidden="true"></i></span><br>
                    @if ($errors->has('nickname'))
                      <span style="color: white; font-family: 'Lato'; font-size: 17px; font-style: normal;">
                        <strong>{{ $errors->first('nickname') }}</strong>
                      </span><br><br>
                    @endif
                </div>
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

                <input type="submit" value="Enviar">
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <!--//main-->
    <br><br>
</div>
@endsection