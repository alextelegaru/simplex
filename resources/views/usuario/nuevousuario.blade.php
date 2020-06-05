



    @extends('layouts.app')

    @section('content')
<style>
        .error {
    border-color:red;
}
</style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <!-- @if (session()->has('success'))
    <div class="alert alert-dismissable alert-success" id="mensaje">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {!! session()->get('success') !!}
        </strong>
    </div>
@endif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div class="text-center" id="mensaje" style="display:none"></div>
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
            enctype="multipart/form-data" >
        {{ csrf_field() }}

    <div class="form-group ">
        <label for="name">Nombre</label>
        <input type="name" class="form-control" name="name" id="name" >
      </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Correo</label>
      <input type="email" name="email" id="email" class="form-control" >
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Rol</label>




        <?php
        $interests = array('admin' => 'Admin',  'camarera' => 'Camarera', 'camarero' => 'Camarero',  'cocinera' => 'Cocinera', 'cocinero' => 'Cocinero');
        ?>
        <select  class="form-control" name="rol" id="rol">






    <option   value="admin">Admin</option>
    <option   value="camarera">Camarera</option>
    <option   value="camarero">Camarero</option>
    <option   value="cocinera">Cocinera</option>
    <option   value="cocinero">Cocinero</option>








        </select>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control"  value="" placeholder="">
          </div>


    </div>
    <div class="form-group">

        <button type="submit" class="btn btn-primary">Añadir usuario</button>

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
        url: "/usuarios",
        data: $('form').serialize(),
        timeout:10000,
        success: function (data) {


            $("#email").removeClass("error");


            if(data.success.includes("correo")){

                $("#mensaje").attr('class', 'alert-danger text-center');
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<p>'+data.success+'</p>');
                $("#email").addClass("error");

                document.getElementById("email").focus();
               $('#email').val('');




            }else{


                if(data.success.includes("Correo incorrecto")){

                    $("#mensaje").attr('class', 'alert-danger text-center');
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').append('<p>'+data.success+'</p>');
                    $("#email").addClass("error");

                    document.getElementById("email").focus();
                   $('#email').val('');




                }else{

                    $("#mensaje").attr('class', 'alert-success text-center');
                    jQuery('.alert-success').show();
                    jQuery('.alert-success').append('<p>'+data.success+'</p>');

                    $('#email').val('');
                    $('#name').val('');
                     $('#password').val('');

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
Crear Usuario
@endsection

@include('menu')
