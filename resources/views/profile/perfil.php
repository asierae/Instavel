<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252"><title>{{ Auth::user()->name }} Perfil</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css_perfil/w3.css">
</head><body>

<!-- Header -->
<header class="w3-display-container w3-content" style="max-width:1500px">
  <img class="w3-image" src="{{url('img_perfil/photographer.jpg')}}" alt="Me" height="400" width="1400">
  <div class="w3-display-middle w3-padding-xlarge w3-border w3-wide w3-text-light-grey w3-center">
    <h1 class="w3-hide-medium w3-hide-small w3-xxxlarge"> {{ Auth::user()->name }}</h1>
    <h5 class="w3-hide-large" style="white-space:nowrap"> {{ Auth::user()->name }}</h5>
    <h3 class="w3-hide-medium w3-hide-small">Aquí va la cita del usuario</h3>
  </div>
  
  <!-- Navbar (placed at the bottom of the header image) -->
  <ul class="w3-navbar w3-light-grey w3-round w3-display-bottommiddle w3-hide-small" style="bottom:-16px">
    <li><a href="#">Álbum</a></li>
    <li><a href="#portfolio">Personal Info</a></li>
    <li><a href="#contact">Amigos</a></li>
    <li><a href="#contact">Novedades</a></li>
  </ul>
</header>

<!-- Navbar on small screens -->
<ul class="w3-navbar w3-light-grey w3-hide-large w3-hide-medium">
    <li><a href="#">Álbum</a></li>
    <li><a href="#portfolio">Personal Info</a></li>
    <li><a href="#contact">Amigos</a></li>
    <li><a href="#contact">Novedades</a></li>
</ul>

<!-- Page content -->
<div class="w3-content w3-padding-xlarge w3-margin-top" id="portfolio">

  <!-- Images (Portfolio) -->
  <img src="img_perfil/ocean.jpg" alt="Ocean" class="w3-image" height="500" width="1000">
  <img src="img_perfil/ocean2.jpg" alt="Ocean II" class="w3-image w3-margin-top" height="500" width="1000">
  <img src="img_perfil/falls2.jpg" alt="Falls" class="w3-image w3-margin-top" height="500" width="1000">
  <img src="img_perfil/mountainskies.jpg" alt="Skies" class="w3-image w3-margin-top" height="500" width="1000">
  <img src="img_perfil/mountains2.jpg" alt="Mountains" class="w3-image w3-margin-top" height="500" width="1000">

  <!-- Contact -->
  <div class="w3-light-grey w3-padding-xlarge w3-padding-32 w3-margin-top" id="contact">
    <h3 class="w3-center">Contact</h3>
   @yield('content');
  </div>

<!-- End page content -->
</div>


</body></html>