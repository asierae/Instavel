@extends('profile.miperfil') @section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>
<script src="{{ url('js/js_perfil_fotos/modernizr.custom.js')}}"></script>
<script src="{{ url('js/js_perfil_fotos/script.js')}}"></script>

<link rel="stylesheet" href="{{ url('css/css_perfil_fotos/style.css')}}" type="text/css" media="all" />

<link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- BODY-->
<div class="main">
	<ul id="og-grid" class="og-grid">
		<?php 

if( count($photos) > 0){
  
  
   foreach($photos as $photo){ 
?>


		<li>
			<a href="#" data-largesrc="{{$photo->path}}" data-title="{{$photo->tittle}}" data-description="{{$photo->description}} <br>TAGS [{{$photo->tags}}] <br>Likes: {{$photo->likes}}
      <br><strtong>Subida el </strong>{{$photo->created_at}} by <a href='/perfil/{{$photo->author}}'>{{$photo->author}}</a><hr>
			<a href='/view/{{$photo->id}}' class='btn btn-xs btn-default' style='height: 40px; width: 200px; top: 30px'><span class='glyphicon glyphicon-edit' style='position: relative; top: 5px'></span>&nbsp&nbsp Edita tu foto...</a>">
			<img src="{{$photo->path}}" alt="{{$photo->photoname}}" width="280px" />
			</a>
			<div>
				<a href="/view/{{$photo->id}}" class="btn btn-xs btn-default" style="width: 280px;"><span class="glyphicon glyphicon-pencil"></span>Editar</a>
			</div>
			<!--  style="position: relative; top: 173px; right: 290px; width: 283px" -->
		</li>
		<?php
   }
     ?>
	</ul>

</div>
</div>
<!-- /container -->

<script src="{{ url('js/js_perfil_fotos/grid.js')}}"></script>
<script>
	$(function() {
		Grid.init();
	});
</script>

		<?php

/*Para paginación
echo str_replace('/?', '?', $usuarios->render() )  ;

}
else
{
*/
  
?>


			<?php  
} else {
?>
			<br>
			<div class='rechazado'>
				<label style="color: black; font-family: verdana; font-size: 20px; font-style: italic; color: #363738;">¡Sube alguna foto! &nbsp Haz clic<a href="{{url ('uploader') }}"> aquí</a></label>
			  <hr style="border-top:1px solid #083972;">
			</div>
			<?php } ?>

	</div>



	@endsection