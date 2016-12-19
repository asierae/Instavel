@extends('profile.miperfil')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>

<link rel="stylesheet" href="{{ url ('/css/css_search/css_search.css') }}">

<h3>
  Búsqueda de Fotos por nombre o tag
</h3>

<div id="wrap" style="background-color:#DDD;font-size:15px;">
  <form action="" autocomplete="on">
  <input id="search" name="search" type="text" placeholder="Busca algún amigo aquí"><input id="search_submit" value="Buscar" type="submit">
  </form>
</div>

<br><br><br><br><br><br><br>

<div id="contenedor">
  
</div>

<script>
$('#search').on('keyup',function(){
  $value=$(this).val();

	      if(($value.length)>=1){
$.post( "search", { tag: $value ,op:'images', _token: "{{ csrf_token() }}"})
  .done(function( data ) {
  $('#contenedor').html(data);
    //alert( "Data Loaded: " + data );
  });
				}
	else{
	
		  $('#contenedor').html('');
	}
})

</script>
@endsection