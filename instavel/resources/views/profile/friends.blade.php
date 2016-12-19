@extends('profile.perfil') @section('content')

<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script> <!-- Latest compiled and minified CSS --> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> <!-- Latest compiled and minified JavaScript --> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 


<link rel="stylesheet" href="{{ url ('/css/css_friends_search/css_friends_search.css') }}">

<div id="wrap" style="background-color:#DDD;font-size:15px;"> <form action="" autocomplete="on"> 
	<input id="search" name="search" type="text" placeholder="Busca algún amigo aquí">
	<input id="search_submit" value="Buscar" type="submit"> </form> 
</div> 

<br><br><br><br><br><br>
<div id="contenedor"> 
</div> 

<?php if($msj=='normal') {
	//mostrar usuarios
	$user2=$user[0];

?> 

	@if ($user2->friends->count()> 0)

	<div id="mensaje"> 
		<h2> Amigos de {{$user2->nickname}} </h2> 
	</div> 
	<table class="table table-bordered"> 
		<tr>
				<th>Usuario:</th>
				<th>Ver Perfil</th>
		</tr> 
		@foreach ($user2->friends as $friend) 
		<tr> 
			<td><a href="/perfil/{{$friend->nickname}}"> {{ $friend->nickname }}
			</a> <img src="/images/{{$friend->nickname}}/avatar.jpg" width="150px" class="avatar img-circle img-thumbnail" style="height: 120px; width: 120px;"></td>
			<td> </span><br><a href="/perfil/{{$friend->nickname}}" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> </a></td>
	</tr>			
	@endforeach 
	</table>

	@else
				<p>
					<label style="color: black; font-family: verdana; font-size: 20px; font-style: italic; color: #363738;">Este usuario no tiene amigos :(</label>
			  	<hr style="border-top:1px solid #083972;">
				</p>
	@endif

<?php	
} else {
	//Añadido friend
?> 
			{{ $msj }}
<?php
}
?> 

<script> $('#search').on('keyup', function() {
	$value=$(this).val();
	if(($value.length)>=1) {
		$.post( "/search", {
			nickname: $value, op:'users', _token: "{{ csrf_token() }}"
		}
		) .done(function( data) {
			$('#contenedor').html(data);
			//alert( "Data Loaded: " + data );
		}
		);
	} //end longitud
	else {
		$('#contenedor').html('');
	}
}

);
$(document).ready(function() {}

); //end ready
</script> @endsection