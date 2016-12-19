@extends('profile.miperfil')

@section('content')
<link rel="stylesheet" href="{{ url('css/css_inbox/style.css')}}" type="text/css" media="all" />
<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>

<div class='container'>
  <div class='container_ui'>
    <div class='container_ui__heading'>
      <div class='header_icon'>
        <img src='/images/{{Auth::user()->nickname}}/avatar.jpg' width="40px">
      </div>
      <h1>
        inbox
      </h1>
      <div class='menu_icon'>
        <div class='div'></div>
        <div class='div'></div>
        <div class='div'></div>
      </div>
    </div>
			@if ($user->messages->count() < 1)
			No tienes mensajes
		@else
			@foreach ($user->messages as $message)
    <input id='message-{{$message->id}}' type='checkbox'>
    <label for='message-{{$message->id}}' href='#move'>
      <div class='container_ui__item'>
        <div class='face'>
          <img src='/images/{{$message->author}}/avatar.jpg' width="80px">
          <div class='color_bar one'>
            <p>Leyendo</p>
            <span width="80px">{{$message->author}}</span>
          </div>
        </div>
        <h2>
          {{$message->tittle}}
        </h2>
        <div class='dot active'></div>
        <h3> {{$message->tittle}}</h3>

      </div>
      <div class='container_ui__expand' id='close'>
        <div class='heading'>
          <div class='heading_head'></div>
          <label for='message-{{$message->id}}'>
            x
          </label>
        </div>
        <div class='body'>
          <div class='user'>
            <div class='face'>
              <img src='/images/{{$message->author}}/avatar.jpg' width="50px">
            </div>
            <div class='details'>
              <h2>{{$message->author}}</h2>
              <h3>{{$message->tittle}}</h3>
            </div>
          </div>
          <div class='content'>
            <p><b>Mensaje</b></br>{{$message->message}}</p>
         
          <center><a href="/messages/add" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-arrow-right"></span> Responder</a></center>
          </div>
        </div>
      </div>
    </label>
   @endforeach
  </div>
</div>
@endif

@endsection