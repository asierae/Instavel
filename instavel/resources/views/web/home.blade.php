<!DOCTYPE html>
<!-- saved from url=(0062)http://www.w3schools.com/w3css/tryw3css_templates_parallax.htm -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
 <style type="text/css">.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}</style>
  <link type="text/css" rel="stylesheet" href="url {{ ('./css') }}"><style type="text/css">.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}</style><style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style><style type="text/css">.gm-style-pbc{transition:opacity ease-in-out;background-color:rgba(0,0,0,0.45);text-align:center}.gm-style-pbt{font-size:22px;color:white;font-family:Roboto,Arial,sans-serif;position:relative;margin:0;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}</style><style type="text/css">.gm-style{font-family:Roboto,Arial,sans-serif;font-size:11px;font-weight:400;text-decoration:none}.gm-style img{max-width:none}</style>
  <title>Bienvenido a Instavel</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
  
<link rel="stylesheet" href="{{ url ('/css/css_home/w3_home.css') }}">
<link rel="stylesheet" href="{{ url ('/css/css_home/css_home.css') }}">
<link rel="stylesheet" href="{{ url ('/css/css_login/style_login.css') }}">
<link rel="stylesheet" href="{{ url ('/css/css_register/style_register.css') }}" type="text/css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  
<style>@media print {#ghostery-purple-box {display:none !important}}</style>

<script type="text/javascript" charset="UTF-8" src="{{ url ('/js/js_home/common.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url ('/js/js_home/map.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url ('/js/js_home/util.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url ('/js/js_home/marker.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url ('/js/js_home/onion.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url ('/js/js_home/stats.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url ('/js/js_home/controls.js') }}"></script>

  
<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

</head>

<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <ul class="w3-navbar" id="myNavbar">
    <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
      <a class="w3-hover-black" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
        <i class="fa fa-bars"></i>
      </a>
    </li>
    <li class="w3-left-align"><a href="{{ url('/home') }}">HOME</a></li>
    @if (Auth::guest()) 
    <li class="w3-hide-small"><a href="{{ url('/login') }}"><i class="fa fa-user"></i> LOGIN</a></li>
    <li class="w3-hide-small"><a href="{{ url('/register') }}"><i class="fa fa-address-card"></i> REGISTRAR</a></li>
     @endif
     @if (!Auth::guest()) 
    <li class="w3-hide-small"><a href="{{ url('/perfil') }}"><i class="fa fa-camera"></i> MI PERFIL</a></li>
    <li class="w3-hide-small"><a href="{{ url('/uploader') }}"><i class="fa fa-cloud-upload"></i> UPLOAD</a></li>    
     @endif
    <li class="w3-hide-small"><a href=""><i class="fa fa-envelope"></i> CONTACT</a></li>
    @if (!Auth::guest()) 
    <li class="w3-hide-small w3-right" style="left: 20%"><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
    @endif
    <li class="w3-hide-small w3-right">
      <a href="{{ url('/search') }}" class="w3-hover-red">
        <i class="fa fa-search"></i>
      </a>
    </li>
  </ul>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium">
    <ul class="w3-navbar w3-left-align w3-white">
      <li><a href="{{ url('/login') }}" onclick="toggleFunction()">LOGIN</a></li>
      <li><a href="{{ url('/register') }}" onclick="toggleFunction()">REGISTER</a></li>
      @if (!Auth::guest()) 
      <li><a href="{{ url('/logout') }}"</a></li>
      @endif
      <li><a href="" onclick="">CONTACT</a></li>
      <li><a href="{{ url('/search') }}">SEARCH</a></li>
    </ul>
  </div>
</div>

@yield('content') 
  
  
<!-- Second Parallax Image with Portfolio Text -->
<div class="bgimg-2 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
    <span class="w3-xxlarge w3-text-light-grey w3-wide">PORTFOLIO</span>
  </div>
</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display=&#39;none&#39;">
  <span class="w3-closebtn w3-text-white w3-opacity w3-hover-opacity-off w3-xxlarge w3-container w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>

<!-- Third Parallax Image with Portfolio Text -->
<div class="bgimg-3 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-light-grey w3-wide">CONTACT</span>
  </div>
</div>

<!-- Container (Contact Section) -->
<div class="w3-content w3-container w3-padding-64" id="contact">

</div>

<!-- Footer -->
  
@include('profile.footer')

</body></html>