@extends('profile.miperfil')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>

<div class="container" style="padding-top: 40px;">
  <h1 class="page-header">Edita tu Perfil</h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        
        <form  method="post" id="miform" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         
          <input type="hidden" name="op" value="imagen">
          <img src="/images/{{Auth::user()->nickname}}/avatar.jpg" id="preview" name="preview" class="avatar img-circle img-thumbnail" style="height: 180px; width: 180px" alt="{{Auth::user()->name}}">
          <h6>Cambiar tu avatar...</h6>
          <input type="file" onchange="loadFile(this)" id="file" name="file" class="text-center center-block well well-sm">
           <input class="btn btn-primary" value="Cambiar Avatar" id="actualizar_avatar" type="button">
          </form>
          <br>
                  <form  method="post" id="miform2" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="op" value="fondo">
          <img src="/images/{{Auth::user()->nickname}}/photographer.jpg" width="200px" id="preview2" name="preview2"  alt="{{Auth::user()->name}}">
          <h6>Cambiar tu fondo...</h6>
          <input type="file" onchange="loadFile2(this)" id="file" name="file" class="text-center center-block well well-sm">
           <input class="btn btn-primary" value="Cambiar Fondo" id="actualizar_fondo" type="button">
          </form>
        </div>
      </div>
      <!-- edit form column -->
      <div class="col-md-7 col-sm-6 col-xs-12 personal-info">
        <div class="alert alert-info alert-dismissable" id="mensaje2">
          <a class="panel-close close" data-dismiss="alert">×</a> 

          <div id="mensaje">


          Actualiza aquí tu <strong>informacion</strong>. Los cambios serán realizados mediante AJAX.
             </div>
        </div>
        <p><h3>Información Personal</h3></p>
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Nombre y Apellidos:</label>
            <div class="col-lg-8">
              <input type="text" id="name" class="form-control" name="name" value="{{Auth::user()->name}}" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Ciudad:</label>
            <div class="col-lg-8">
              <input class="form-control" id="city" name="city" value="{{Auth::user()->city}}" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Cita:</label>
            <div class="col-lg-8">
              <input class="form-control" id="cita" name="cita" value="{{Auth::user()->cita}}" type="text">
            </div>
          </div>
          <div class="form-group">
          <label class="col-md-3 control-label">Sobre Mi:</label>
            <div class="col-lg-8">
              <textarea class="form-control" rows="5" id="aboutme" name="aboutme">{{Auth::user()->aboutme}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tipo de Perfil:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="tipo" class="form-control">
                  @if ( Auth::user()->tipocuenta == "private" )
                      <option value="public">Público</option>
                      <option value="private" selected="selected">Privado(Sólo seguidores)</option>
                  @else
                      <option value="public" selected="selected">Público</option>
                      <option value="private">Privado(Sólo seguidores)</option>
                  @endif                  
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label">Contraseña:</label>
            <div class="col-md-8">
              <input class="form-control" id="password" value="" type="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirmación:</label>
            <div class="col-md-8">
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Seguidores:</label>
            <div class="col-lg-8">
							<div class="form-control" style="width: 35px"> {{Auth::user()->followers}} </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Actualizar Perfil" id="actualizar" type="button">
              <span></span>
              <input class="btn btn-default" value="Cancel" type="reset">
             </div>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
  
$('#actualizar').on('click',function() {
  
        var name=$('#name').val();
        var city=$('#city').val();
        var cita=$('#cita').val();
        var aboutme=$('#aboutme').val();
        var tipo=$('#tipo').val();
        var password=$('#password').val();
        var password_confirmation=$('#password_confirmation').val();

        $.post("/info/update", {'name': name,'city':city,'cita':cita,'aboutme':aboutme,'tipocuenta':tipo,'password':password,'password_confirmation':password_confirmation,'_token':'{{csrf_token()}}','op':'texto'},
        function(result)
        {
            $("#mensaje").hide();
            $("#mensaje").slideDown(1000);
            $("#mensaje").html(result);
        });
}); 
  
$('#actualizar_avatar').on('click',function(){
var fd = new FormData(document.getElementById('miform')); 
       $.ajax({
        url: '/info/update',
        data: fd,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
          $("#mensaje").html(data);
        }
    });

}); 
$('#actualizar_fondo').on('click',function(){
var fd = new FormData(document.getElementById('miform2')); 
       $.ajax({
        url: '/info/update',
        data: fd,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
          $("#mensaje").html(data);
        }
    });

}); 
function loadFile(input){
   if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview')
                    .attr('src', e.target.result)
                    .width(310)
                    .height(300);
            };

            reader.readAsDataURL(input.files[0]);
        }
}
  function loadFile2(input){
   if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview2')
                    .attr('src', e.target.result)
                    .width(350)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
}

</script>
@endsection