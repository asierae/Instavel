@extends('web.home')

@section('content')
<!-- First Parallax Image with Logo Text -->
<div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap">
    <span class="w3-center w3-padding-xlarge w3-black w3-xlarge w3-wide w3-animate-opacity">_ <span class="w3-hide-small">INSTAVEL</span> _</span>
    <br><br><br><br>
    <span class="w3-center w3-padding-xlarge w3-black w3-xlarge w3-wide w3-animate-opacity"><span class="w3-hide-small"><?php echo $msj;?></span></span>
   </div>
</div>
@endsection