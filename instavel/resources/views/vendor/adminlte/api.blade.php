 @if (Auth::guest()) 
					<?php
			header('Location:/admin');
			exit();
		?>
@endif
@if(Auth::user()->role!='ADMIN')

		<?php
			// Baia Baia
			header('Location:/admin');
	exit();
		?>

@endif
@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Api Keys Manager Num Activas: {{$numkeys}} keys</strong></div>
					<div class="panel-body">
							@if(isset($msj))
						{{$msj}}
						@else
						  <div class="col-md-5">
    		<form class="form-horizontal">

<div id="msj">
					<strong><p>
						
						Enviar Key a Usuario</p></strong>
					</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tittle">Key</label>  
  <div class="col-md-4">
  <input id="key" name="key" placeholder="KEY" class="form-control input-md" required="" type="text" style="width: 400px"> 
		<a onclick="generate()" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-random"></span> Generar Key</a>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tittle">Usuario</label>  
  <div class="col-md-4">
  <input id="user" name="user" placeholder="nickname" class="form-control input-md" required="" type="text" style="width: 400px"> 
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tittle">Hits</label>  
  <div class="col-md-4">
  <input id="hits" name="user" placeholder="100" class="form-control input-md" required="" type="number" style="width: 100px"> 
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="enviar"></label>
  <div class="col-md-4">
 <a id="enviar" onclick="registerKey()" class="btn btn-default"><span class="fa fa-key"></span> Registrar Key</a>
  </div>
</div>

</form>

						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	
			<script>
			function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
	
    return pass;
}

function generate() {
	
		 var key=randomPassword(20);

    document.getElementById('key').value = key;
}
				
	function registerKey(){
		
		$.post( "/admin/panel/api/add", { key: $('#key').val(),'user':$('#user').val(),'hits':$('#hits').val(), '_token': "{{ csrf_token() }}"})
  .done(function( data ) {
           $('#msj').html(data);
		
				
		});
	}
			
			</script>

@endsection
