



    @extends('layouts.app')

    @section('content')


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div class=" border-primary row align-items-center justify-content-center">
        <div class="row">



            <div class="container">
                <div class="row">
                    <div class="col-4">
                      <div class="text-center">


                      </div>
                    </div>
                </div>
            </div>



            <form class="form-horizontal" role="form" method="post"
            enctype="multipart/form-data" action="{{ route('usuarios.store') }}">
        {{ csrf_field() }}

    <div class="form-group ">
        <label for="name">Nombre</label>
        <input type="name" class="form-control" name="name" >
      </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Correo</label>
      <input type="email" name="email" class="form-control" id="exampleFormControlInput1" >
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Rol</label>




        <?php
        $interests = array('admin' => 'Admin',  'camarera' => 'Camarera', 'camarero' => 'Camarero',  'cocinera' => 'Cocinera', 'cocinero' => 'Cocinero');
        ?>
        <select  class="form-control" name="rol">






    <option   value="admin">Admin</option>
    <option   value="camarera">Camarera</option>
    <option   value="camarero">Camarero</option>
    <option   value="cocinera">Cocinera</option>








        </select>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" name="password" class="form-control"  value="" placeholder="">
          </div>


    </div>
    <div class="form-group">

        <button type="submit" class="btn btn-primary">Actualizar</button>

    </div>
  </form>
</div>
</div>






@endsection


@include('menu')
