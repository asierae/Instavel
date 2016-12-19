@extends('profile.perfil')

@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="{{ url('css/css_perfil_fotos/style.css')}}" type="text/css" media="all" />
<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>
<script src="{{ url('js/js_perfil_fotos/modernizr.custom.js')}}"></script>
<script src="{{ url('js/js_perfil_fotos/script.js')}}"></script>
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

if( count($photos) >0){
  
  
   foreach($photos as $photo){ 
?>
         
     
					<li>
						<a href="#" data-largesrc="{{$photo->path}}" data-title="{{$photo->tittle}}" data-description="{{$photo->description}} <br>TAGS [{{$photo->tags}}] <br>Likes: {{$photo->likes}}
             <br><strtong>Subida el </strong>{{$photo->created_at}} by <a href='/perfil/{{$photo->author}}' class=' margin: 0;border: 0;'>{{$photo->author}}</a><hr>
							<a href='/view/{{$photo->id}}' class='btn btn-xs btn-default' style='height: 40px; width: 200px; top: 30px'><span class='glyphicon glyphicon-file' style='position: relative; top: 5px'></span>&nbsp&nbsp Leer más...</a>">
							<img src="{{$photo->path}}" alt="{{$photo->photoname}}" width="280px"/>

						</a>
						<div>	
							<a id="like" onclick="addLike({{$photo->id}})" class="btn btn-xs btn-default" style="width: 280px;"><span class="glyphicon glyphicon-heart-empty"></span> Like It!</a>
							<div id="{{$photo->id}}msj" hidden></div>
						</div>
            </li>
					       

  <?php
   }
     ?>		
  </ul>

			</div>
		</div><!-- /container -->	

		<script src="{{ url('js/js_perfil_fotos/grid.js')}}"></script>

		<script>
			$(function() {
				Grid.init();
			});
			
			function addLike($idphoto)
			{
				$.post("/like/"+$idphoto, {'_token':'{{csrf_token()}}'},
				function(result)
				{
          $("#"+$idphoto+"msj").hide();
          $("#"+$idphoto+"msj").slideDown(2000);
        	$("#"+$idphoto+"msj").html('¡Ahora la foto tiene <strong>' + result + '</strong><span class="glyphicon glyphicon-heart" style="margin-left:7px"></span> !');
    		});
			}
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
				<label style="color: black; font-family: verdana; font-size: 20px; font-style: italic; color: #363738;">Este usuario aún no ha subido fotos :(</label>
			  <hr style="border-top:1px solid #083972;">
			</div>
			<?php } ?>

	</div>



@endsection