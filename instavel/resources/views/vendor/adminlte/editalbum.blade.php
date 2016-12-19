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
								@if(isset($msj))
						{{$msj}}
							@else
					<div class="panel-heading">Edición de fotos de {{$photos[0]->author}}</div>
					<div class="panel-body">
				
<div id="contenedor">
					<strong><p>
						
						Fotos</p></strong>
					</div><br>
				@foreach($photos as $photo)
					<table id="{{$photo->id}}">
						<td>	<img src="{{$photo->path}}" width="200px"></td>
				<td>
				<a onClick="deletePhoto({{$photo->id}})" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Borrar Foto</a>
				<a href="/view/{{$photo->id}}" class="btn btn-success"><span class="glyphicon glyphicon-photo"></span> Ver publicación</a>
				</td>
					
					</table>
						
				@endforeach
						
						
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	
			<script>
			function deletePhoto(id){

$.post( "/admin/panel/deleteimg", { id: id, _token: "{{ csrf_token() }}"})
  .done(function( data ) {
			$('#'+id).fadeOut(400, function(){
           $('#'+id).remove();
			});
	
	$('#contenedor').hide();
  $('#contenedor').html('<h4>'+data+'</h4>');
	$("#contenedor").slideDown("slow");
  });
			


			}
			
			</script>

@endsection
