









<!--

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>



<head>


    <style>




 p {
margin-top: 0;
margin-bottom: 0;
line-height: /* adjust to tweak wierd fonts */;
}
    </style>
</head>

-->
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
@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <div class="container mt-5 border-primary">
        <div class="text-center" id="mensaje" style="display:none"></div>
        <div class="row">


    <?php

    $limite=count($usuarios);
    function roleado($id){
        if($id==0){
            return "Admin";
        }else{

            if($id==1){
            return "Camarero";
        }else{
            return "Cocinero";



        }


        }

    }



    ?>

    @for ($i = 0; $i <$limite; $i++)



    <div class="row" id={{$usuarios[$i]['id']}}>

          <div class=" container-fluid clearfix border-primary" name={{$usuarios[$i]['id']}} >
            <div class="card clearfix limite border-primary">






            <img src=<?php echo "/img/".$usuarios[$i]['rol'].".jpg" ; ?> alt="card-1" class="card-img-top clearfix" height="150px" width="100px">

              <div class="card-body clearfix ">
                <div class="text-center">

                    <p class="font-weight-bold">{{$usuarios[$i]['name']}}</p>
                    <p>{{$usuarios[$i]['rol'] }}</p>
                    <div class="btn-group-vertical">
                    <a href="/usuario/{{$usuarios[$i]['id']}}" class="btn btn-warning">Editar</a>
                  {{-- <a href="/usuario/{{$usuarios[$i]['id']}}" class="btn btn-danger">Eliminar</a>
--}}




    <button class="btn btn-danger" value={{$usuarios[$i]['id']}} onclick="eliminar(this)">Eliminar</button>


                </div>




                  </div>





          </div>
        </div>
      </div>





    </div>


    @endfor


</div>

</div>




@endsection


@section('script')



function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =this.responseText;



    }
  };
  xhttp.open("GET", "/usuarios", true);
  xhttp.send();
}

function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").empty();
    $("#mensaje").css("display", "none");
  }, 2000);
}


function eliminar(id)
{
    sessionStorage.setItem("eliminado",id.value);
  $.ajax({
    url:"/eliminarUsuario/"+id.value,

    data:{},
    dataType:"json",
    type:"get",

    timeout: 50000,
    success:function(data)
    {


      x=data.success;

      $("#mensaje").attr('class', 'alert-success text-center');
      jQuery('.alert-success').show();
      jQuery('.alert-success').append('<p>'+x+'</p>');

      idEliminado=sessionStorage.getItem("eliminado");
      document.getElementById(idEliminado).remove();
      limpiar();




    }


  });



}





$("#mensaje").on("click", function(event) {
    $("#mensaje").remove();
    console.log("asa");
    event.preventDefault();
});







@endsection



@include('menu')
