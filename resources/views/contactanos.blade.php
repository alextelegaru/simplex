@extends('layouts.app')
@section("content")



<link href="{{ asset('css/contactanos.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap/4.3.1/css/bootstrap.min.css') }}" rel="stylesheet">





<script type="text/javascript" src="{{URL::asset('js/bootstrap/4.1.1/js/bootstrap.min.js')}}"></script>
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>-->



<script type="text/javascript" src="{{URL::asset('js/jquery/3.2.1/jquery.min.js')}}"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->



<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<div class="container">
  <!------   <h2 class="text-center">Contac Form</h2>
	<div class="row justify-content-center">---------->
		<div class=" izda col-12 col-md-8 col-lg-6 pb-5">
            <div class="text-center" id="mensaje" style="display:none"></div>

                    <!--Form with header-->

                    <form action="mail.php" method="post">
                        <div class="card border-primary rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-info text-white text-center py-2">
                                    <h3><i class="fa fa-envelope"></i> Contáctanos</h3>
                                    <p class="m-0 texto-negro">Con gusto te ayudaremos</p>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nombre" name="nombre"  disabled="disabled" value={{ Auth::user()->name }} placeholder="Nombre y Apellido">
                                    </div>
                                </div>

<!--
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="nombre" name="email" placeholder="ejemplo@gmail.com" value="admin@admin.com" required>
                                    </div>
                                </div>

                            -->

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                        </div>
                                        <textarea class="form-control" placeholder="Envianos tu Mensaje" id="mensajeSoporte" ></textarea>
                                    <input type="text" value={{ Auth::user()->name }} id="nombrePerfil" hidden>
                                    <input type="text" value={{ Auth::user()->rol }} id="rolPerfil" hidden>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="submit"  id="enviarSoporte" value="Enviar" class="btn btn-info btn-block rounded-0 py-2">
                                </div>
                            </div>

                        </div>
                    </form>
                    <!--Form with header-->


                </div>
	</div>
</div>

@endsection


@section("title")
Contáctanos
@endsection


@include('menu')



@section('script')


$("#enviarSoporte").click(function(e) {
    e.preventDefault();


if($.trim($("#mensajeSoporte").val()).length>10){


    var mensaje = $.trim($("#mensajeSoporte").val());
    var nombre = document.getElementById("nombrePerfil").value;
    var rol=document.getElementById("rolPerfil").value;

    var token = '{{csrf_token()}}';

    $.ajax({
        type: "POST",
        url: "/soporte",
        data: {
            _token:token,
            mensaje:mensaje,
            nombre:nombre,
            rol:rol,

        },
        success: function(result) {

            $("#mensaje").attr('class', 'alert-success text-center');
            jQuery('.alert-success ').show();
            jQuery('.alert-success').append('<p>'+result.success+'</p>');
         limpiar();
         $('#mensajeSoporte').val('');

        },
        error: function(result) {
            alert('error');
        }
    });








}else{

    $("#mensaje").attr('class', 'alert-danger text-center');
    jQuery('.alert-danger ').show();
    jQuery('.alert-danger').append('<p>'+"Mensaje demasiado corto."+'</p>');
          $('#mensajeSoporte').focus();
          limpiar();




}



});

function limpiar(){

setTimeout(
    function()
    {
      $("#mensaje").text('');
      $("#mensaje").css("display", "none");
    }, 2000);
}
@endsection
