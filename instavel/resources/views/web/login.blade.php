@extends('web.home')

@section('content')
<!-- Container (Login Section) -->
<div class="bgimg-1 w3-display-container w3-opacity-min" id="login">
    <br><br><br>
    <div class="container w3" padding="40px 0px 40px 0px">
        <h2>Login</h2>
        <?php echo '<h2 style="color: white;">'. $msj . '</h2>';?>
        <form role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <div class="username">
                  <span class="username">Nick:</span>
                  <input type="text" name="nickname" id="nickname" class="name" placeholder="Tu nick" required>
                  <div class="clear"></div>
              </div>
              @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <div class="password-agileits">
                <span class="username">Contraseña:</span>
                <input type="password" name="password" id="password" class="password" placeholder="***********" required>
                <div class="clear"></div>
              </div>
              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="rem-for-agile">
                <input type="checkbox" name="remember" class="remember">Recuérdame<br>
                <a href="{{ url('password/reset') }}">¿Has olvidado tu contraseña?</a><br>
            </div>
            <div class="login-w3">
                <input type="submit" class="login" value="Entra ya">
            </div>
            <div class="clear"></div>
        </form>
    </div>
    <br><br>
</div>
@endsection