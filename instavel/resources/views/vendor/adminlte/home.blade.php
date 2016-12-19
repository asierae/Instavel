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
<link rel="stylesheet" href="{{ url ('/css/css_admin/css_admin.css') }}">

<h1 style="margin-left: 35%">
	Estadísticas globales
</h1>
<hr style="border-top:1px solid #333;">
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<table>
					<tr>
						<td>Número de usuarios:</td>
						<td> {{$data[0]}} </td>
					</tr>
					<tr>
						<td>Número de fotos totales:</td>
						<td> {{$data[1]}} </td>
					</tr>
					<tr>
						<td>Número de suscritos a Instavel:</td>
						<td> {{$data[2]}} </td>
					</tr>
					<tr>
						<td>Número de comentarios totales:</td>
						<td> {{$data[3]}} </td>
					</tr>
				</table>
				<table>
					<tr>
						<td>Usuario más seguido:</td>
						<td> <a href="/perfil/{{$data[4]->nickname}}"> {{$data[4]->nickname}} </a> </td>
						<td> <a href="/perfil/{{$data[4]->nickname}}"><img src="/images/{{$data[4]->nickname}}/avatar.jpg"></a></td>
						<td> Número de seguidores: </td>
						<td> {{$data[4]->followers}} </td>
					</tr>
				</table>
				<table>
					<tr>
						<td>Foto más famosa:</td>
						<td> <a href="/view/{{$data[5]->id}}"><img src="{{$data[5]->path}}"></a> </td>
						<td> Autor: </td>
						<td> <a href="/perfil/{{$data[5]->author}}">{{$data[5]->author}}</a> </td>
					</tr>
				</table>
			</div>
		</div>
	</div>

@endsection
