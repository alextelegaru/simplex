<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Simplex' }}</title>

   <link rel='stylesheet' type='text/css' href="{{ asset('css/estilos.css') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
body {
        background-image: url("/img/"+"fondo.jpg");
       }

       .nav-bar{
           widows:50px;
           position: absolute;

       }

       .nav-bar:hover{
           color: yellow;
       }
#sidebar{
    bottom:81.8%;
}


#app{
    height: 100%;
}

#mensaje{
    position: relative;
    left: 75px;
    z-index: 64;
}
a:hover, a:visited, a:link, a:active
{
    text-decoration: none;
}


    </style>

</head>
<body>

    <div class="vertical-nav bg-white nav-bar" id="sidebar">


            @yield('menu')
          </div>


      </div>







    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('Simplex', 'Simplex') }}



                    <img src="/img/logo.png" alt="" height="50px">





                </a>


                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                          <!--  <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> -->
                            @if (Route::has('register'))
                              <!--    <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>-->
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Conectado {{ Auth::user()->name }} <img src=<?php echo "/img/".Auth::user()['rol'].".jpg" ; ?> alt="card-1" class="" width="60px" height="40px" ><span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=<?php echo "/usuario/".Auth::user()['id'] ; ?>>
                                     {{ __('Perfil') }}
                                    </a>





                                    @if (Auth::user()->rol=='admin')

                                    <a class="dropdown-item" href="/usuarios/">
                                        {{ __('Cuentas') }}
                                       </a>


                                @endif






                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

            </div>
        </nav>

        <main class="py-4 ">
                <div class="container-fluid">

                    @yield('content')

                </div>


        </main>


        <div id="footer">
            <div class="container text-center">
              <p class="text-muted credit" style="color:#fff">Simplex S.A</p>
            </div>
          </div>



    </div>
</body>



<script>
        $(document).ready(function(){
  $('#sidebarxCollapse').trigger('click');
});


@yield('script')

</script>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
</html>
