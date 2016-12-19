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
					<div class="panel-heading"><strong>Envío de Newsletter</strong></div>
					<div class="panel-body">
							@if(isset($msj))
						{{$msj}}
						@else
						  <div class="col-md-5">
    		<form class="form-horizontal">

<div id="contenedor">
					<strong><p>
						
						Esribe aquí tu mensaje, se enviará a todos los usuarios.</p></strong>
					</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tittle">Título</label>  
  <div class="col-md-4">
  <input id="tittle" name="tittle" placeholder="Título del E-Mail" class="form-control input-md" required="" type="text" style="width: 300px"> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="msj">Mensaje</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="msj" name="msj" style="width:400px" rows="10"></textarea>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="enviar"></label>
  <div class="col-md-4">
 <a id="enviar" onclick="sendNews()" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span> Enviar NewsLetter</a>
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
			function sendNews(){

	  var tittle=$('#tittle').val();
		var msj=$('#msj').val();
$.post( "/admin/panel/sendnewsletter", { tittle: tittle,msj:msj , _token: "{{ csrf_token() }}"})
  .done(function( data ) {
	$('#contenedor').hide();
  $('#contenedor').html('<h4>'+data+'</h4>');
	$("#contenedor").slideDown("slow");
    //alert( "Data Loaded: " + data );
  });
			


			}
			
			</script>

@endsection
