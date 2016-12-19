@extends('profile.miperfil')

@section('content')

<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>
<!-- /.modal compose message -->
    <div class="modal show" id="modalCompose">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Envia un mensaje</h4>
          </div>
          <div id="mensaje">
            
          </div>
          <div class="modal-body">
            <form role="form" class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-2" for="inputTo">Destinatario</label>
                  <div class="col-sm-10"><input class="form-control" id="receiver" placeholder="Nickname"  required type="text" style="width:450px"></div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2" for="inputSubject">Título</label>
                  <div class="col-sm-10"><input class="form-control" id="tittle" placeholder="subject" required type="text" style="width:450px"></div>
                </div>
                <div class="form-group">
                  <label class="col-sm-12" for="inputBody">Mensaje</label>
                  <div class="col-sm-6"><textarea class="form-control" id="message" required rows="5" style="width:450px"></textarea></div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
 
            <button type="button" onClick="sendMessage()" class="btn btn-primary ">Enviar <i class="fa fa-arrow-circle-right fa-lg"></i></button>
            
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal compose message -->
<script>
  
function sendMessage(){
  
        var tittle=$('#tittle').val();
        var message=$('#message').val();
        var receiver=$('#receiver').val();

        $.post("/messages/send", {'tittle': tittle,'message':message,'receiver':receiver,'_token':'{{csrf_token()}}'},
        function(result)
        {
            $("#mensaje").hide();
            $("#mensaje").slideDown(1000);
            $("#mensaje").html(result);
        });
}
  

</script>
@endsection