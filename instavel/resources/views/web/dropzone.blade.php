@extends('profile.miperfil')

@section('content')

<!DOCTYPE html>

<html>

<head>

    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>

    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

     <script src="/js/js_dropzone/dropzone.min.js"></script>

</head>

<body>


<div style="padding: 3% 0% 2% 2%">
    <h4>Arrastra aquí tus fotos. Se guardarán automáticamente.</h4><hr style="border-top:1px solid #083972;">  
</div>
  
<div class="container">

    <div class="row">

        <div class="col-md-12" style="padding-right: 25%">     

            {!! Form::open([ 'route' => [ 'upload.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
          
            <!-- <button id="upload-submit" class="btn btn-default margin-t-5"><i class="fa fa-upload"></i> Publicar Imágenes</button>
            -->
            {!! Form::close() !!}        

        </div>

    </div>

</div>


<script type="text/javascript">

        Dropzone.options.imageUpload = {

            maxFilesize         :       1,

            acceptedFiles: ".jpeg,.jpg,.png,.gif"

        };

</script>


</body>

</html>
@endsection