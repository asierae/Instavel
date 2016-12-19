<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<script src="{{ url('js/js_perfil_fotos/jquery-1.10.1.min.js')}}"></script>

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/images/{{Auth::user()->nickname}}/avatar.jpg" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="/perfil"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="post" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search" id="searchuser" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search-btn' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <div id="tmp">
   
          </div>
            <li class="header">Instavel</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="/admin/panel"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="/admin/panel/newsletter"><i class='fa fa-link'></i> <span>Enviar NewsLetter</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Admin Contenido</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/admin/panel/users">Usuarios</a></li>
                    <li><a href="/admin/panel/api">API Keys</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
      <script>
 

$('#searchuser').on('keyup',function(){
  $value=$(this).val();

	      if(($value.length)>=1){
$.post( "/admin/panel/search", { nickname: $value ,op:'users', _token: "{{ csrf_token() }}"})
  .done(function( data ) {
  $('#mensaje').html(data);
    //alert( "Data Loaded: " + data );
  });
				}
	else{
	
		  $('#mensaje').html('');
	}
})

</script>
    </section>
    <!-- /.sidebar -->
</aside>
