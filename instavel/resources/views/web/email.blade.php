@extends('web.home')


@section('content')

<div class="bgimg-1 w3-display-container w3-opacity-min" id="login">
    <br><br><br>
    <div class="container w3" padding="40px 0px 40px 0px">
        <h2>Solicitud de restablecer contraseña</h2>
        <form role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <div class="username">
                  <span class="username">E-Mail:</span>
                  <input type="email" name="email" id="email" class="name" placeholder="ejemplo@host.com" required>
                  <div class="clear"></div>
              </div>
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <div class="login-w3">
                <input type="submit" class="login" value="Solicitar">
            </div>
            <div class="clear"></div>
        </form>
    </div>
    <br><br>
</div>


@endsection

