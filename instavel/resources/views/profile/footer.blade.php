


	<link rel="stylesheet" href="{{url('css/footer/demo.css')}}">
	<link rel="stylesheet" href="{{url('css/footer/footer-distributed-with-address-and-phones.css')}}">
		<link rel="stylesheet" href="{{url('css/footer/footer-distributed-with-contact-form.css')}}">
	
	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

	<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">


		

		<footer class="footer-distributed">

			<div class="footer-left">

				<h3>Insta<span>vel</span></h3>
				<br>

	

				<h3>Suscríbete al NewsLetter</h3>
				<div id="contenedor">
					
				</div>
				<form action="" method="post">

					<input type="email" id="email" name="email" placeholder="Email" />
					<input type="button" onclick="suscribir(email.value)" value="Enviar"/>

				</form>

			

				<p class="footer-company-name">Instavel &copy; 2016/17</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>UPV/EHU</span> San Sebastian, Spain</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+34 684314814</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:laraveland@gmail.com">laraveland@gmail.com</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>About the company</span>
					Proyecto final para sistemas web 2016/17
				</p>

				<div class="footer-icons">

					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>

				</div>

			</div>
			<script>
			function suscribir(email){
	
	      if((email.length)>=1){
$.post( "/addsub", { email: email , _token: "{{ csrf_token() }}"})
  .done(function( data ) {
  $('#contenedor').html('<h3>'+data+'</h3>');
    //alert( "Data Loaded: " + data );
  });
			
}

			}
			
			</script>

		</footer>


