

@section('menu')



<link href="{{ asset('css/menu.css') }}" rel="stylesheet">





<div class="wrapperx">
    <nav id="sidebarx">
        <div class="sidebarx-header">
            <h3>Opciones Disponibles</h3>
        </div>


        <ul class="list-unstyled components">



 @if (Auth::user()->rol=="admin")
<!--
 <li class="active">
    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
    <ul class="collapse list-unstyled" id="homeSubmenu">
        <li>
            <a href="#">home1</a>
        </li>
        <li>
            <a href="#">home2</a>
        </li>
        <li>
            <a href="#">home3</a>
        </li>
    </ul>
</li>    -->

@endif








@if (Auth::user()->rol=="camarero"||Auth::user()->rol=="camarera"||Auth::user()->rol=="admin")
            <li>
                <a class="negro" href="/crearPedido">Hacer Pedido</a>
            </li>
@endif

<li>
    <a  class="negro" href="{{ url('/pedidos') }}" >Pedidos</a>
</li>


@if (Auth::user()->rol=="cocinero"||Auth::user()->rol=="cocinera"||Auth::user()->rol=="admin")

<li>
    <a  class="negro" href="{{ url('/menu') }}" id="menuDeHoy">Menu de Hoy</a>
</li>
@endif


@if (Auth::user()->rol=="cocinero"||Auth::user()->rol=="cocinera"||Auth::user()->rol=="admin")
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Menu</a>
                <ul class=" collapse list-unstyled" id="pageSubmenu">

                    <li>
                        <a class="negro" href="{{ url('/crearMenu') }}"  id="crearMenuHoy">Crear Menu</a>
                    </li>
                    <li>
                        <a class="negro" href="{{ url('/menu') }}" id="editarMenuHoy">Editar Menu</a>
                    </li>


                </ul>
            </li>
            <li>
                <a  class="negro" href="{{ url('/productos') }}">Productos</a>
            </li>

            @endif

            @if (Auth::user()->rol=="admin")



            <li>
                <a href="#pageSubmenus" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Usuarios</a>
                <ul class=" collapse list-unstyled" id="pageSubmenus">

                    <li>
                        <a class="negro" href="/crearUsuario">Crear usuario</a>
                    </li>
                    <li>
                        <a class="negro" href="/usuarios">Usuarios</a>
                    </li>


                </ul>
            </li>






@endif



            <li>
                <a class="negro" href="/contactanos">Contactanos</a>
            </li>





        </ul>

        <ul class="list-unstyled CTAs">
            <!--    <li>
            <a href="#" class="article">Download code</a>

                <a class="download" href="{{ url('/menu') }}">Menu de Hoy</a>
            </li>-->


            <li>
                <!--  <a href="#" class="article">Download code</a>  -->

                  <a class="download" href=<?php



                  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $parsedUrl = parse_url($url);
                    $root = "'".strstr($url, $parsedUrl['path'], true) . '/';echo $root."usuario/".Auth::user()->id."'" ;?> >Perfil</a>
              </li>


            <li>




                <a class="download" hidden
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Cerrar Sesion') }}
             </a>

             <a class="download" id="cerrarSesion2"
             onclick="preguntame()">
              {{ __('Cerrar Sesion') }}
          </a>



             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
            </li>
        </ul>
    </nav>



        <button type="button" id="sidebarxCollapse" class="btn btn-info">
            <i class="fa fa-align-justify"></i> <span class="vertical-text">Menu</span>
        </button>



    </div>






    <link href="{{ asset('css/fonts2.cs') }}" rel="stylesheet">
   <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script type="text/javascript" src="{{URL::asset('js/jquery/3.3.1/slim.min.js')}}"></script>

    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
    <script type="text/javascript" src="{{URL::asset('popper/1.14.3/umd/popper.min.js')}}"></script>


   <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
<script type="text/javascript" src="{{URL::asset('js/bootstrap/4.1.3/js/bootstrap.min.js')}}"></script>
    <script>
	    $(document).ready(function(){
			$('#sidebarxCollapse').on('click',function(){
				$('#sidebarx').toggleClass('active');

			});
        });







var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today =yyyy+ '-' + mm + '-' + dd  ;

if(document.getElementById("menuDeHoy")){
    document.getElementById("menuDeHoy").href=document.getElementById("menuDeHoy").href+"/"+today;
//document.getElementById("crearMenuHoy").href=document.getElementById("crearMenuHoy").href+"/"+today;

document.getElementById("editarMenuHoy").href=document.getElementById("editarMenuHoy").href+"/"+today;

}


function preguntame(){

Swal.fire({
              title: '¿Estás seguro?',
              text: "La sesión se cerrará.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'Cancelar',
            }).then((result) => {
              if (result.value) {






                document.getElementById("cerrarSesion").click()






  }
})



}


	</script>



@endsection
