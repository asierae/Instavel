@extends('profile.miperfil')

@section('content')


<!-- TRUCO!-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,100); } </script>
<!-- //For-Mobile-Apps -->

<!-- Custom-Stylesheet-Links -->
<!-- Bootstrap-Core-CSS --> 	<link rel="stylesheet"	href="{{url('css/css_news/bootstrap.min.css')}}" 	type="text/css" media="all" />
<!-- Index-Page-CSS --> 	<link rel="stylesheet"	href="{{url('css/css_news/style.css')}}" 		type="text/css" media="all" />




@if (true)
<div id="mensaje">
	<h2>
			<br>
			Últimas Publicaciones de tus amigos
	</h2>
	<br><br>
</div>
<?php 
//$photos=$photos[1];//hacer otro for?

$pos=0;
for ($x = 0; $x < count($photos); $x++) {
	$photosall=$photos[$x];
?>
  @foreach ($photosall as $p)
	@if($pos==0)
<?php $pos=1;?>

  	<div class="about-grid1 w3layouts">
				<div class="col-md-6 col-sm-6 about-grid about-info">
					<h3 class="news" style="margin: 7px 0 0 0">{{$p->tittle}}</h3>
					<br>
					<p style="margin: 7px">{{$p->description}}</p><br>
					<table>
						<tr><center><img src="/images/{{$p->author}}/avatar.jpg"  class="avatar img-circle img-thumbnail" style="height: 100px; width: 100px;" width="80px"></center></tr>
						<tr><h5 class="news"><a href="perfil/{{$p->author}}">Autor: - {{$p->author}} -</a></h5></tr>
       					</table>
				</div>
				<div class="col-md-6 col-sm-6 about-grid about-image">
						<a href="/view/{{$p->id}}"><img src="{{$p->path}}" alt="{{$p->photoname}}" width="250px"></a>
				</div>
				<div class="clearfix"></div>
			</div>

@else
		<?php $pos=0;?>
			<div class="about-grid2 w3l-agile">
				<div class="col-md-6 col-sm-6 about-grid about-image">
					<a href="/view/{{$p->id}}"><img src="{{$p->path}}" alt="{{$p->photoname}}" width="250px"></a>
				</div>
				<div class="col-md-6 col-sm-6 about-grid about-info">
				<h3 class="news" style="margin: 7px 0 0 0">{{$p->tittle}}</h3>
				<p style="margin: 7px">{{$p->description}}</p><br>
					<table>
						<tr><center><img src="/images/{{$p->author}}/avatar.jpg"  class="avatar img-circle img-thumbnail" style="width: 100px; height: 100px"></center></tr>
						<tr><h5 class="news"><a href="perfil/{{$p->author}}">Autor: - {{$p->author}} -</a></h5></tr>
       		</table>
				</div>
				<div class="clearfix"></div>
			</div>
@endif
  @endforeach
<?php } ?>
@else
 <p>
  No tienes Novedades
</p>  
@endif


		</div>


@endsection