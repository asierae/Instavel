<?php
if(is_null($user)){
  exit();
}
$user=$user[0];//me devuelvo un json,luego cogemos el primer array 
?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<title>Perfil de {{ $user->nickname }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ url ('css/css_perfil/w3.css') }}">
<link rel="stylesheet" href="{{ url ('/css/css_home/w3_home.css') }}">
<link rel="stylesheet" href="{{ url ('/css/css_home/css_home.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
  
  
 <body style="background-image: url(/images/images_profile/main_background.png)">

<!-- Header -->
<header class="w3-display-container w3-content" style="max-width:100%">
    <?php $url='/images/'.$user->nickname.'/photographer.jpg'?>
  <img src="{{ $url }}" alt="{{$user->name}}" height="350" width="100%">
  <div class="w3-display-middle w3-padding-xlarge w3-border w3-wide w3-text-light-grey w3-center">
    <h1 class="w3-hide-medium w3-hide-small w3-xxxlarge"> {{ $user->nickname }}</h1>
    <h5 class="w3-hide-large" style="white-space:nowrap"> {{ $user->nickname }}</h5>
    <h3 class="w3-hide-medium w3-hide-small">{{ $user->cita }}</h3>
     <?php $url2='/images/'.$user->nickname.'/avatar.jpg'?>
     <img class="w3-image" src="{{ $url2 }}" alt="Me"  style="border-radius: 50%;box-shadow: 0 0 8px rgba(0, 0, 0, .8); height: 110px; width: 110px;" height="110" width="110">
  </div>
  
  <!-- Navbar (placed at the bottom of the header image) -->
  <ul class="w3-navbar w3-light-grey w3-round w3-display-bottommiddle w3-hide-small" style="bottom:-16px">
    <li><a style="color: black;" href="/perfil">Mi Perfil</a></li>
    <li><a style="color: black;" href="/perfil/{{$user->nickname}}/info">Información personal</a></li>
    <li><a style="color: black;" href="/perfil/{{$user->nickname}}/friends">Amigos</a></li>
  </ul>
</header>

<!-- Navbar on small screens -->
<ul class="w3-navbar w3-light-grey w3-hide-large w3-hide-medium">
    <li><a style="color: black;" href="/perfil">Mi Perfil</a></li>
    <li><a style="color: black;" href="/perfil/{{$user->nickname}}/info">Información personal</a></li>
    <li><a style="color: black;" href="/perfil/{{$user->nickname}}/amigos">Amigos</a></li>
</ul>
  

  <div class="w3-top">
  <ul class="w3-navbar" id="myNavbar">
    <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
      <a class="w3-hover-black" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
        <i class="fa fa-bars"></i>
      </a>
    </li>
    <li class="w3-left-align"><a href="{{ url('/home') }}" style="color: white;">HOME</a></li>
    @if (!Auth::guest()) 
    <li class="w3-hide-small w3-right" style="left: 20%"><a href="{{ url('/logout') }}" style="color: white;"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
    @endif
     @if (!Auth::guest()) 
    <li class="w3-hide-small"><a href="{{ url('/perfil') }}" style="color: white;"><i class="fa fa-camera"></i> MI PERFIL</a></li>  
     @endif
    <li class="w3-hide-small w3-right"><a href="{{ url('/messages') }}" style="color: white;"><i class="fa fa-envelope"></i> INBOX</a></li>
    <li class="w3-hide-small w3-right">
      <a href="{{ url('/search') }}" class="w3-hover-red" style="color: white;">
        <i class="fa fa-search"></i>
      </a>
    </li>
  </ul>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium">
    <ul class="w3-navbar w3-left-align w3-white">
      <li><a href="{{ url('/login') }}" onclick="toggleFunction()" style="color: white">LOGIN</a></li>
      <li><a href="{{ url('/register') }}" onclick="toggleFunction()" style="color: white">REGISTER</a></li>
      @if (!Auth::guest()) 
      <li><a href="{{ url('/logout') }}" style="color: white;"</a></li>
      @endif
      <li><a href="{{ url('/messages') }}" style="color: white;">INBOX</a></li>
      <li><a href="{{ url('/search') }}" style="color: white;">SEARCH</a></li>
    </ul>
  </div>
</div>
  
  
  
  
<!-- Page content -->
<div class="w3-content w3-padding-xlarge w3-margin-top" id="portfolio">

  <!-- Images (Portfolio) -->
 

   <?php 
    if($error){
      echo 'Usuario no registrado '. $error;
    }
    else{
    ?>
   @yield('content')
    <?php } ?>
 

<!-- End page content -->
</div>

  

@include('profile.footer')
  
</body>


</html>