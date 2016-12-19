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
					<a href="/admin/panel/users">Volver</a>
							@else
					<div class="panel-heading">Edición de usuarios</div>
					<div class="panel-body">
				
<div id="contenedor">
					<strong><p>
						
						Usuarios Actuales: {{$cuantos}}</p></strong>
					</div><br>
				@foreach($users as $user)
	<div class="container-fluid well span6">
	<div class="column-fluid">
        <div class="span2" >
		    <img src="/images/{{$user->nickname}}/avatar.jpg" style="width: 120px; height: 120px;" width="150px" class="img-circle">
					<img src="/images/{{$user->nickname}}/photographer.jpg" width="100px">
        </div>
        
        <div class="span8">
            <h3>Usuario: {{$user->nickname}}</h3>
            <h6>Email:{{$user->email}}</h6>
            <h6>Ubicación: {{$user->city}}</h6>
            <h6>Creado: {{$user->created_at}}</h6>
            <h6><a href="/admin/panel/edit/{{$user->nickname}}">Ver más... </a></h6>
        </div>
        
        <div class="span2">
            <div class="btn-group">
                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                    Acción
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/panel/edit/{{$user->nickname}}"><span class="icon-wrench"></span> Administrar Fotos</a></li>
                    <li><a href="/admin/panel/delete/{{$user->nickname}}"><span class="icon-trash"></span> Borrar Usuario</a></li>
                </ul>
            </div>
        </div>
</div>
</div>
						
				@endforeach
						{{ $users->links() }}
						
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
