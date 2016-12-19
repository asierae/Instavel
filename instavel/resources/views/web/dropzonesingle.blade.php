@extends('profile.miperfil') @section('content')


<!DOCTYPE html>

<html>

<head>


  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>

  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

  <script src="/js/js_dropzone/dropzone.min.js"></script>


</head>

<body>
  <div class="container" style="padding: 3% 20% 0 0">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-heading">
          Publica una foto. Añádele un título y una descripción. ¡Compártela!
        </div>
        
        <div class="panel-body" style="margin: 2% 2% 2% 2%; padding: 2% 2% 2% 2%; background-color: #337ab7; color: white;" id="contenido" hidden>
          <div id="mensaje"></div>
        </div>
        
        <div class="panel-body">
          {!! Form::open(['route'=> 'upload_single.store', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}
                    <div class="dropzone-previews"></div>

          <label>Título</label>
          <div>
            <input type="text" id="tittle" name="tittle" style="  background-color: #3CBC8D; color: white;" class="form-control input-md">
          </div>

          <br>
          <label>Descripción</label>
          <div>
            <textarea id="description" name="description" style="  background-color: #3CBC8D; color: white;" class="form-control input-md"></textarea>
          </div>
         
          <br>
          <label>Tags</label>
          <input id="tags" name="tags" placeholder="tag1,tag2,tag3" style="  background-color: #3CBC8D;color: white;" class="form-control input-md" type="text">
          <span class="help-block">Tags separados por comas (Ej:animales,paisaje,etc)</span>

          <br>
          <label>Tipo de Publicación</label>

          <select id="mode" name="mode" class="form-control" style="  background-color: #3CBC8D;color: white;">
            <option value="public">Publica</option>
            <option value="private">Privada</option>
            <option value="onlyfriends">Solo Amigos</option>
          </select><br>
          
          <div class="dz-message" style="height:200px;">
            <hr style="border-top:1px solid #083972;">
              Arrastra/Inserta aquí tu imágen
            <hr style="border-top:1px solid #083972;">
          </div>
          
          <button type="submit" class="btn btn-success" id="submit">Publicar Foto</button> {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>


  <script>
    Dropzone.options.myDropzone = {
      autoProcessQueue: false,
      uploadMultiple: false,
      maxFilezise: 10,
      maxFiles: 1,

      init: function() {
        var submitBtn = document.querySelector("#submit");
        myDropzone = this;

        submitBtn.addEventListener("click", function(e) {
          e.preventDefault();
          e.stopPropagation();
          myDropzone.processQueue();
        });
        this.on("addedfile", function(file) {
          // alert("file uploaded");
        });

        this.on("complete", function(file) {
          $('#contenido').hide();
          $('#contenido').slideDown("slow");
          myDropzone.removeFile(file);
          $('#mensaje').html('<h4>¡Publicación Realizada! Mira en tu <a style="color: #a9e8e0" href="/perfil">perfil</a>. </h4>');
        });

        this.on("success",
          myDropzone.processQueue.bind(myDropzone)
        );
      }
    };
  </script>
</body>
@endsection