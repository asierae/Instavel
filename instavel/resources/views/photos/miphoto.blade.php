@extends('profile.miperfil') @section('content')

<html>

<head>

	<link rel="stylesheet" href="{{url('css/css_photo/style.css')}}" type="text/css" media="all" />
	<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>
	<script type="text/javascript" src="{{url('js/js_photo/jquery.lightbox.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{url('css/css_photo/lightbox.css')}}" media="screen" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script type="text/javascript">
		$(function() {
			$('.gallery a').lightBox();
		});
	</script>
</head>

<body>

	<div class="container" style="padding-top: 3px;">
		<h1 class="page-header">Editar Publicación</h1>
		<div class="row">
			<!-- left column -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="text-center">
					<div class="gallery">
						<ul style="list-style-type: none">
							<li><a href="{{$photo->path}}"><img style="max-width:100%;display: block;"  src="{{$photo->path}}" alt="" /></a></li>
							<!-- Si metro aqui otra <li> con imagen al pulsar en una tengo ya el carrusel  -->
							<div class="clear"></div>
						</ul>
					</div>
					<a href="/delete/{{$photo->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Borrar</a>
					<br>
				</div>
			</div>
			<!-- edit form column -->
			<div class="col-md-7 col-sm-6 col-xs-12 personal-info">
				<div class="alert alert-info alert-dismissable" id="mensaje2">
					<a class="panel-close close" data-dismiss="alert">×</a>
					<div id="mensaje">


						Edita aquí tu <strong>publicación</strong>. Los cambios seran realizados mediante AJAX.
					</div>
				</div>
				<h3>Información de la Foto</h3>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label style="background-color=#111111;" class="col-lg-3 control-label">Título:</label>
						<div class="col-lg-8">
							<input class="form-control" id="tittle" name="tittle" value="{{$photo->tittle}}" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Descripción:</label>
						<div class="col-lg-8">
							<textarea class="form-control" rows="5" id="description" name="description">{{$photo->description}}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label">Tags:</label>
						<div class="col-lg-8">
							<input class="form-control" id="tags" name="tags" value="{{$photo->tags}}" type="text">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label">Tipo de Publicación:</label>
						<div class="col-lg-8">
							<div class="ui-select">
								<select id="mode" class="form-control">
                <option value="public" selected="selected">Público</option>
                <option value="private">Privado(Nadie podrá ver tus fotos)</option>
                <option value="onlyfriends">Sólo amigos</option>
              </select>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<input class="btn btn-primary" value="Actualizar Publicación" id="actualizar" type="button">
							<span></span>
							<input class="btn btn-default" value="Cancel" type="reset">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--COMENTARIOS -->
	<div class="container">
		<div class="col-lg-4 col-sm-6 text-center">
			<div class="well">

				<h4>Que te parece esta foto?</h4>
				<div id="msj">
					:)
				</div>
				<div class="input-group">
					<input type="text" id="userComment" class="form-control input-sm chat-input" placeholder="Escribe aquí tu comentario..." />
					<span class="input-group-btn" onclick="insertComment(userComment.value)">     
            <a class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-comment"></span> Añadir Comentario</a>
					</span>
				</div>

				<hr data-brackets-id="12673">
				<ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
					<table id="tcomments">
						<tbody>
							<tr>
								@if ($photo->comments->count()> 0) 
								@foreach ($photo->comments->reverse() as $comment)
								<div id="c{{$comment->id}}">
									<tr>
										<strong class="pull-left primary-font"><img src="/images/{{$comment->author}}/avatar.jpg" style="width: 50px; height: 50px;" width="50px" class="avatar img-circle img-thumbnail""><a href="/perfil/{{$comment->author}}">{{$comment->author}}</a></strong>
										<small class="pull-right text-muted">
           					<span class="glyphicon glyphicon-time"></span>{{$comment->created_at}}</small>
										</br>
										<li class="ui-state-default">{{$comment->comment}}</li>
										<li><a onClick="delCom({{$comment->id}})" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </a></li>

										</br>
									</tr>
								</div>
								@endforeach
		
					@else
					<li class="ui-state-default">Esta foto aún no tiene comentarios, se tú el primero!</li>
					@endif
						</tr>
						</tbody>
					</table>
				</ul>

			</div>
		</div>
	</div>
</body>

	<!-- END COMETARIOS -->

	<script>
		$('#actualizar').on('click', function() {

			var tittle = $('#tittle').val();
			var description = $('#description').val();
			var tags = $('#tags').val();
			var mode = $('#mode').val();

			$.post("/edit/{{$photo->id}}", {'tittle': tittle,'description': description,'tags': tags,'id_user': {{$photo->id_user}},'mode': mode,'_token': '{{csrf_token()}}','op': 'texto'},
				function(result) {
					$("#mensaje").html(result);
				});
		});

		function insertComment(comment) {
			$.post("/addcomment", {
					'id': '{{$photo->id}}',
					'comment': comment,
					'author': '{{Auth::user()->nickname}}',
					'_token': '{{csrf_token()}}',
					'op': 'texto'
				},
				function(result) {
					$("#msj").html(result);
					$('#tcomments tr:first').prepend('<tr>' +
						'<td><strong class="pull-left primary-font">' +
						'<img src="/images/{{Auth::user()->nickname}}/avatar.jpg" style="width: 50px; height: 50px;" width="50px" class="avatar img-circle img-thumbnail"">' +
						'<a href="/perfil/{{Auth::user()->nickname}}">{{Auth::user()->nickname}}</a></strong>' +
						'<small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span> Hace unos segundos...</small>' +
						'</br><li class="ui-state-default">' + comment + '</li>' +
						'</br></td></tr>');
				});

		}

		function delCom(id) {
			$.post("/delcomment", {
					'id': id,
					'_token': '{{csrf_token()}}'
				},
				function(result) {
					$("#msj").html('<strong>'+result+'</strong>');
					$('#c'+ id).fadeOut(400, function() {
						$('#c' + id).remove();
					});
				});
		}
	</script>

</html>


@endsection