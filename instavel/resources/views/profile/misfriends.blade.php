@extends('profile.miperfil') @section('content')
<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{ url ('/css/css_friends_search/css_friends_search.css') }}">

<div id="wrap" style="background-color:#DDD;font-size:15px;">
	<form action="" autocomplete="on">
		<input id="search" name="search" type="text" placeholder="Busca algún amigo aquí"><input id="search_submit" value="Buscar" type="submit">
	</form>
</div>

<br><br><br><br><br><br>

<div id="contenedor">

</div>

<?php
	if($msj=='normal') {//mostrar usuarios
?>



	@if ($user->friends->count() > 0)
	<div id="mensaje">
		<h2>
			Mis Amigos
		</h2>
	</div>
	<table class="table table-bordered">
		<tr>
			<th>Usuario:</th>
			<th>Acción</th>
		</tr>
		
		@foreach ($user->friends as $friend)

		<tr>
			<td><a href="/perfil/{{$friend->nickname}}">{{ $friend->nickname }}</a> <img src="/images/{{$friend->nickname}}/avatar.jpg" style="width: 120px; height: 120px;" width="150px" class="avatar img-circle img-thumbnail"></td>
			<td><a class="table-remove btn btn-danger"><span class="glyphicon glyphicon-remove"></span>  </a></span><br><a href="/perfil/{{$friend->nickname}}" class="btn btn-success"><span class="glyphicon glyphicon-user"></span>  </a></td>
		</tr>			
		
		@endforeach

	</table>

		@else
				<p>
					<label style="color: black; font-family: verdana; font-size: 20px; font-style: italic; color: #363738;">No tienes amigos :( Busca algunos mediante la barra</label>
			  	<hr style="border-top:1px solid #083972;">
				</p>
		@endif

<?php
}
else if($msj=='newfriend') {
?>

<h5>
  Ahora sigues a <a href="/perfil/{{$newfriend}}">{{$newfriend}}</a> 
</h5>

<?php
	} else { //Añadido friend
?>

						{{$msj}}

<?php
}  
?>
							
<script>
	$('#search').on('keyup', function() 
	{
		$value = $(this).val();
		if (($value.length) >= 1) 
		{
			$.post("/search", {
				nickname: $value,
				op: 'users',
				_token: "{{ csrf_token() }}"
			}).done(function(data) {
				$('#contenedor').html(data);
				//alert( "Data Loaded: " + data );
			});
		} //end longitud
		else {
			$('#contenedor').html('');
		}
	});
	
	$(document).ready(function() {
		$('.table-remove').click(function() 
		{
			var nickname = $(this).closest('tr').find('td:first-child').text();
			$(this).parents('tr').css("background-color", "#FF3700");
			$(this).parents('tr').fadeOut(400, function() {
				$(this).parents('tr').remove();
			});

			$.post("/delfriend/" + nickname, {
				nickname: nickname,
				'_token': '{{csrf_token()}}',
				op: "borrar"
			}, function(data) { //basename($_SERVER['PHP_SELF'])
				$("#mensaje").html(data);
			}).fail(function(response) {
				alert('Error borrar: ' + response.responseText);
			});
		}); //end click
	}); //end ready
	
</script>

@endsection