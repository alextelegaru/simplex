

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
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

<script type="text/javascript" src="{{URL::asset('js/jquery/3.4.1/jquery.min.js')}}"></script>

@if (session()->has('success'))
    <div class="alert alert-dismissable alert-success" id="mensaje">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {!! session()->get('success') !!}
        </strong>
    </div>
@endif



<link href="{{ asset('css/usuario/usuario.css') }}" rel="stylesheet">


<div class="text-center" id="mensaje" style="display:none"></div>
    <div class=" border-primary row align-items-center justify-content-center">

        <div class="row">



            <div class="container">
                <div class="row">
                    <div class="col-4">
                      <div class="text-center">
                        <img id="imagenPerfil"src=<?php echo "/img/".$usuario['rol'].".jpg" ; ?> alt="card-1" class="" width="155px" height="125px" >


                      </div>
                    </div>
                </div>
            </div>



            <form method="POST" action="/usuarios/{{ $usuario->id }}">

                {{ csrf_field() }}
        {{ method_field('PATCH') }}
    <div class="form-group ">
        <label for="name">Nombre</label>
        <input type="name" class="form-control anchoInput" name="name" id="name"value={{ $usuario['name'] }}>
      </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Correo</label>
      <input type="text" name="email" id="email"class="form-control" id="correo" value={{ $usuario['email'] }}>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Rol</label>




        <?php
        $interests = array('admin' => 'Admin',  'camarera' => 'Camarera', 'camarero' => 'Camarero',  'cocinera' => 'Cocinera', 'cocinero' => 'Cocinero');
        ?>
        <select  class="form-control" name="rol" id="rol">





      @if( Auth::user()->rol == 'admin')
    <option  <?php if( $usuario['rol']  == 'admin' ): ?> selected="selected"<?php endif; ?> value="admin">Admin</option>
    <option  <?php if( $usuario['rol']  == 'cocinera' ): ?> selected="selected"<?php endif; ?> value="cocinera">Cocinera</option>
    <option  <?php if( $usuario['rol']  == 'cocinero' ): ?> selected="selected"<?php endif; ?> value="cocinero">Cocinero</option>
    <option  <?php if( $usuario['rol']  == 'camarera' ): ?> selected="selected"<?php endif; ?> value="camarera">Camarera</option>
    <option  <?php if( $usuario['rol']  == 'camarero' ): ?> selected="selected"<?php endif; ?> value="camarero">Camarero</option>

      @endif
    <option    selected="selected" value=<?php echo $usuario['rol'];?> ><?php echo ucfirst($usuario['rol']); ?></option>







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



@section('script')

function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").empty();
    $("#mensaje").css("display", "none");
  }, 2000);
}




$(function () {

    $('form').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: "/usuarios/{{ $usuario->id }}",
        data: $('form').serialize(),
        timeout:10000,
        success: function (data) {

            $("#name").removeClass("error");
            $("#email").removeClass("error");

          if(data.success.includes("nombre")){
            $("#name").addClass("error");
            $("#mensaje").attr('class', 'alert-danger text-center');
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').append('<p>'+data.success+'</p>');

            document.getElementById("name").focus();

           // $('#name').val('');

          }else{



            if(data.success.includes("correo")){

                $("#mensaje").attr('class', 'alert-danger text-center');
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<p>'+data.success+'</p>');
                $("#email").addClass("error");

                document.getElementById("email").focus();
                //$('#email').val('');




            }else{



                if(data.success.includes("Ya existe un usuario con este correo.")){

                    $("#mensaje").attr('class', 'alert-danger text-center');
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').append('<p>'+data.success+'</p>');
                    $("#email").addClass("error");

                    document.getElementById("email").focus();
                   // $('#email').val('');




                }else{



                    if(data.success.includes("actualizados")){


                        $("#mensaje").attr('class', 'alert-success text-center');
                        jQuery('.alert-success').show();
                        jQuery('.alert-success').append('<p>'+data.success+'</p>');

                        $("#name").removeClass("error");
                        $("#email").removeClass("error");


                        //var base_url = window.location.origin+'/';
                        rol=document.getElementById('rol').value;
                        document.getElementById("imagenPerfil").src='/img/'+rol.toLowerCase()+".jpg"


                    }







                }



























            }







          }











        limpiar();
        }
      });

    });

  });








setTimeout(function() {
    $('#mensaje').fadeOut('fast');
  }, 3000);
@endsection
@section("title")
Perfil
@endsection
@include('menu')

