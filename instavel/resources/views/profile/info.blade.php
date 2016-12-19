@extends('profile.perfil')

@section('content')
<?php
if(is_null($user)){
  exit();
}
$usuario=$user[0];//me devuelvo un json,luego cogemos el primer array 
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>

<div class="container" style="padding-top: 10px;">
  <h1 class="page-header"><a href="/perfil/{{$usuario->nickname}}">{{$usuario->nickname}}</a></h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="/images/{{$usuario->nickname}}/avatar.jpg" id="preview" name="preview" class="avatar img-circle img-thumbnail" style="height: 180px; width: 180px;" alt="{{$usuario->name}}">
        <br>     
        <div id="follow" style="margin-top:30px">         
					@if($follow != 1)
						<a class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Seguir</a>
					@else
						 <a class="table-remove btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Dejar de seguir</a>   
					@endif
        </div>
      </div>
    </div>
		
		      <!-- edit form column -->
      <div class="col-md-7 col-sm-6 col-xs-12 personal-info">
        <div class="alert alert-info alert-dismissable" id="mensaje2">
          <a class="panel-close close" data-dismiss="alert">×</a> 

          <div id="mensaje">
						Perfil actualizado de <strong>{{ $usuario->name }}</strong>.
          </div>
        </div>
        <p><h3>Información Personal</h3></p>
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Nombre y Apellidos:</label>
            <div class="col-lg-8">
							<div id="name" class="form-control" name="name" > {{ $usuario->name }}</div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Ciudad:</label>
            <div class="col-lg-8">
              <div class="form-control" id="city" name="city"> {{ $usuario->city }} </div>
            </div>
          </div>
					
          <div class="form-group">
            <label class="col-lg-3 control-label">Cita:</label>
            <div class="col-lg-8">
							<div class="form-control" id="cita" name="cita"> {{ $usuario->cita }} </div>
            </div>
          </div>
          <div class="form-group">
         		<label class="col-md-3 control-label">Sobre Mi:</label>
            <div class="col-lg-8">
          		<div class="form-control" id="aboutme" name="aboutme" style="height: 100px"> {{ $usuario->aboutme }} </div>
            </div>
        	</div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tipo de Perfil:</label>
            <div class="col-lg-8">
							<div class="form-control" id="tipo" name="tipo"> {{ $usuario->tipocuenta }} </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Seguidores:</label>
            <div class="col-lg-8">
							<div class="form-control" id="likes" name="likes"> {{ $usuario->followers }} </div>
            </div>
          </div>
      </form>
    </div>
			
			
  </div>
</div>

<script>
  

$('#seguir').on('click',function(){

        var name=$('#name').val();
       var file=$('#file').src;
        $.post("/follow/{{$usuario->nickname}}", {'_token':'{{csrf_token()}}'},
           function(result){
        $("#mensaje").html(result);
        $("#follow"),html('<a class="table-remove btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Unfollow</a>');
         
    });
});
  
		$('.table-remove').click(function() 
		{
		

			$.post("/delfriend/{{$usuario->nickname}}", {
				'nickname': '{{$usuario->nickname}}',
				'_token': '{{csrf_token()}}',
				op: "borrar"
			}, function(data) { //basename($_SERVER['PHP_SELF'])
				$("#mensaje").html(data);
        $("#follow").html('<a href="/addfriend/{{$usuario->nickname}}" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Seguir</a>');
        
			}).fail(function(response) {
				alert('Error borrar: ' + response.responseText);
			});
		}); //end click

</script>
@endsection