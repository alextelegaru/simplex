

<!--
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<html>



<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>




 p {
margin-top: 0;
margin-bottom: 0;
line-height: /* adjust to tweak wierd fonts */;
}
    </style>
</head>

-->


@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <div class=" border-primary row align-items-center justify-content-center">
        <div class="row">



            <div class="container">
                <div class="row">
                    <div class="col-4">
                      <div class="text-center">
                        <img src=<?php echo "/img/".$usuario['rol'].".jpg" ; ?> alt="card-1" class="" width="155px" height="125px" >


                      </div>
                    </div>
                </div>
            </div>



            <form method="POST" action="/usuarios/{{ $usuario->id }}">

                {{ csrf_field() }}
        {{ method_field('PATCH') }}
    <div class="form-group ">
        <label for="name">Nombre</label>
        <input type="name" class="form-control" name="name" value={{ $usuario['name'] }}>
      </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Correo</label>
      <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value={{ $usuario['email'] }}>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Rol</label>




        <?php
        $interests = array('admin' => 'Admin',  'camarera' => 'Camarera', 'camarero' => 'Camarero',  'cocinera' => 'Cocinera', 'cocinero' => 'Cocinero');
        ?>
        <select  class="form-control" name="rol">





      @if($rol  == 'admin')
    <option  <?php if( $usuario['rol']  == 'admin' ): ?> selected="selected"<?php endif; ?> value="admin">Admin</option>
    <option  <?php if( $usuario['rol']  == 'camarera' ): ?> selected="selected"<?php endif; ?> value="camarera">Camarera</option>
    <option  <?php if( $usuario['rol']  == 'camarero' ): ?> selected="selected"<?php endif; ?> value="camarero">Camarero</option>
    <option  <?php if( $usuario['rol']  == 'cocinera' ): ?> selected="selected"<?php endif; ?> value="cocinera">Cocinera</option>

    @else
    <option    selected="selected" value=<?php echo $usuario['rol'];?> ><?php echo ucfirst($usuario['rol']); ?></option>

    @endif





        </select>
        <div class="form-group">
            <label for="contraseña">Cambiar Contraseña</label>
            <input type="password" name="password" class="form-control"  value="" placeholder="opcional">
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

