

@extends('layouts.app')

@section('content')


 <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>-->

<script type="text/javascript" src="{{URL::asset('npm/sweetalert2@9')}}"></script>

<script type="text/javascript" src="{{URL::asset('js/jquery/3.3.1/jquery.js')}}"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>-->
    <link href="{{ asset('css/bootstrap/4.3.1/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->


       <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
       <script type="text/javascript" src="{{URL::asset('js/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>


    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">-->
       <link href="{{ asset('css/bootstrap-select/1.12.2/css/bootstrap-select.min.css') }}" rel="stylesheet">


 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>-->
       <script type="text/javascript" src="{{URL::asset('js/bootstrap-select/1.12.2/js/bootstrap-select.min.js')}}"></script>


    <link href="{{ asset('css/productos/productos.css') }}" rel="stylesheet">



</head>
  <body>
    <div class="text-center" id="mensaje" style="display:none"></div>
<div class="container">

<div class="row">

<div class="col-sm-4" style="background-color:white;">   <h1>Primeros</h1>  <select id="primero" size=5>

    <?php
$limite=count($primeros);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$primerosIds[$i].'">'.$primeros[$i].'</option>';

}
?>

</select>



</div>

<div class="col-sm-4" style="background-color:white;">   <h1>Segundos</h1>  <select  id="segundo" size=5>

    <?php
$limite=count($segundos);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$segundosIds[$i].'">'.$segundos[$i].'</option>';

}
?>

</select></div>
<div class="col-sm-4" style="background-color:white;">   <h1>Postres</h1>  <select id="postre" size=5>

    <?php
$limite=count($postres);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$postresIds[$i].'">'.$postres[$i].'</option>';

}
?>

</select>

</div>
<div class="col-sm-4" style="background-color:white;">   <h1>Bebidas</h1>  <select id="bebida" size=5>

    <?php
$limite=count($bebidas);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$bebidasIds[$i].'">'.$bebidas[$i].'</option>';

}
?>

</select>


</div>











<div class="col-sm-4" style="background-color:white;">


    <div class="row">
        <div class="panel-heading"><h4>Producto Nuevo</h4></div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="">
                </div>






                <div class="form-group">

                <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" >
                    <option value="primero">Primero</option>
                    <option value="segundo">Segundo</option>
                    <option value="postre">Postre</option>
                    <option value="bebida">Bebida</option>
                </select>
                </div>


                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="any" name="precio" id="precio" value="">
                </div>


                <div class="form-group">
                    <button class="btn btn-success" id="crear">Crear Producto</button>
                    <button class="btn btn-danger" id="eliminar" onclick="eliminar()">Eliminar Producto</button>
            </div>









            </div>
        </div>


    </div>

    <div class="col-sm-4">

        <h4>Modificación Producto</h4>
        <br>
        <div class="form-group">
        <label for="nombre">Nombre</label>
        <input class="ancho" type="text" name="nombreCambio" id="nombreCambio" value="">
    </div>
        <div class="form-group">

            <label for="nombre">Precio</label>
            <input class="masAncho"type="text" name="precioCambio" id="precioCambio" value="">

        </div>
        <div class="form-group">
            <button class="btn btn-warning masAncho" id="actualizar" >Actualizar</button>
    </div>
    </div>





</div>





<div class="col-sm-4" style="background-color:white;">
    <br><br><br><br><br><br>

    </div>
    </div>









</div>




</div>












</div>










</html>
@endsection


@section('script')

    ordenar();





    function limpiar(){
        setTimeout(
      function()
      {
        $("#mensaje").text('');
        $("#mensaje").css("display", "none");
      }, 3150);
    }











    /*

        $('#primero').change(function(){
    sessionStorage.setItem("valor",$(this).val());
    console.log($(this).parent().attr("id"));

    if (!$('#segundo option[value="' +$(this).val()+ '"]').prop("selected", true).length) {
            alert('No such option');
        }{
            console.log("esta");
        }
        });*/

    /*
    $(document).click(function(event) {
        varlistaActual= $(event.target).parent()[0].id;
    });
    */






    function limpiar(){
        setTimeout(
      function()
      {
        $("#mensaje").text('');
        $("#mensaje").css("display", "none");
      }, 2000);
    }















    $("#crear").click(function (e) {
        e.preventDefault();

    var nombre= document.getElementById("nombre").value;
    var tipo= document.getElementById("tipo").value;
    var precio= document.getElementById("precio").value;
        var token = '{{csrf_token()}}';
        var data={
            tipo:tipo,
            nombre:nombre,
            precio:precio,
            _token:token,
            _method:'POST'}
        $.ajax({
            type: "POST",
            url: '/productos',
            data: data,
            timeout: 50000,
            success: function (data) {

                $("#nombre").removeClass("error");
                $("#precio").removeClass("error");




                              if(data.success){

                                var original=data.success.toLowerCase();



                                if(original.includes("campos")){


                                    $("#nombre").addClass("error");
                                    $("#precio").addClass("error");
                                    document.getElementById("nombre").focus();
                                    document.getElementById("precio").focus();







                                    $("#mensaje").attr('class', 'alert-danger text-center');
                                    jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').append('<p>'+data.success+'</p>');


                                }else{









                                    if(original.includes("nombre")){

                                        document.getElementById("nombre").focus();
                                        $("#nombre").addClass("error");
                                        //$('#nombre').val('');

                                        $("#mensaje").attr('class', 'alert-danger text-center');
                                        jQuery('.alert-danger').show();
                                        jQuery('.alert-danger').append('<p>'+data.success+'</p>');



                                    }else{

                                        if(original.includes("nombre incorrecto")){

                                            document.getElementById("nombre").focus();
                                            $("#nombre").addClass("error");
                                            //$('#nombre').val('');

                                            $("#mensaje").attr('class', 'alert-danger text-center');
                                            jQuery('.alert-danger').show();
                                            jQuery('.alert-danger').append('<p>'+data.success+'</p>');



                                        }else{








                                        if(original.includes("precio")){
                                            document.getElementById("precio").focus();
                                            $("#precio").addClass("error");
                                            //$('#precio').val('');

                                            $("#mensaje").attr('class', 'alert-danger text-center');
                                            jQuery('.alert-danger').show();
                                            jQuery('.alert-danger').append('<p>'+data.success+'</p>');

                                        }else{
                                            substring=data.success.split(":");
                                            $("#mensaje").attr('class', 'alert-success text-center');
                                            jQuery('.alert-success').show();
                                            jQuery('.alert-success').append('<p>'+substring[0]+'</p>');
                                            limpiar();

                                            //var primeros= $("#"+tipo+ "option").map(function() {return $(this).val();}).get();
                                            // primeros.push(data.success);
                                            //primeros.sort();

                                            // console.log(primeros);


                                            var sel = document.getElementById(tipo);


                                            var opt = document.createElement('option');


                                            opt.appendChild( document.createTextNode(document.getElementById("nombre").value) );

                                            opt.value = substring[2].slice(1, -3);

                                            // add opt to end of select box (sel)
                                            sel.appendChild(opt);



                                            ordenar();
                                            $('#nombre').val('');
                                            $('#precio').val('');
                                            $('#tipo option').eq(0).prop('selected', true);


                                        }

                                    }









                                    }

                                }

                            }
                            limpiar();

            }
            ,
            error: function (data) {

       console.log("error");


            }


        });
    });




function cambioDatos(){
    var nombre= document.getElementById("nombreCambio").value;
    var precio= document.getElementById("precioCambio").value;


    var id= sessionStorage.getItem("idProd");
    $(varlistaActual +'option[value="'+id+'"]').text(nombre);
}





    $("#actualizar").click(function (e) {
        e.preventDefault();




    var nombre= document.getElementById("nombreCambio").value;
    var precio= document.getElementById("precioCambio").value;


    var id= sessionStorage.getItem("idProd");
    //$(varlistaActual +'option[value="'+id+'"]').text(nombre);


        var token = '{{csrf_token()}}';
        var data={
            nombre:nombre,
            precio:precio,
            _token:token,
            _method:'POST'}
        $.ajax({
            type: "POST",
            url: '/actualizar/'+id,
            data: data,
            success: function (data) {


                $("#nombreCambio").removeClass("error");
                $("#precioCambio").removeClass("error");



                if(data.success){

                    var original=data.success.toLowerCase();



                    if(original.includes("requeridos")){

                        document.getElementById("nombreCambio").focus();
                        $("#nombreCambio").addClass("error");


                        document.getElementById("precioCambio").focus();
                        $("#precioCambio").addClass("error");



                        $("#mensaje").attr('class', 'alert-danger text-center');
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<p>'+data.success+'</p>');

                    }else{


                        if(original.includes("nombre")){

                            document.getElementById("nombreCambio").focus();
                            $("#nombreCambio").addClass("error");
                            $("#mensaje").attr('class', 'alert-danger text-center');
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append('<p>'+data.success+'</p>');

                        }else{



                            if(original.includes("precio")){

                                document.getElementById("precioCambio").focus();
                                $("#precioCambio").addClass("error");
                                $("#mensaje").attr('class', 'alert-danger text-center');
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<p>'+data.success+'</p>');

                            }else{

                                $("#mensaje").attr('class', 'alert-success text-center');
                                jQuery('.alert-success').show();
                                jQuery('.alert-success').append('<p>'+data.success+'</p>');


                                cambioDatos();
                                    ordenar();






                            }









                        }




                    }






























                }
                limpiar();




















            }
            ,
            error: function (data) {

       console.log("error");


            }


        });
    });


function eliminarConfirmado(){
    aEliminar=document.getElementById(sessionStorage.getItem("lista")).value;
    var x = document.getElementById(sessionStorage.getItem("lista"));
    x.remove(x.selectedIndex);
    var token = '{{csrf_token()}}';
    var data={
        _token:token,
        _method:'delete'};


        $.ajax({
            type: "POST",
            url: '/productos/'+aEliminar,
            data: data,
            success: function (data) {
                              if(data.success){
                                $("#mensaje").attr('class', 'alert-success text-center');
                                jQuery('.alert-success').show();
                                  jQuery('.alert-success').append('<p>'+data.success+'</p>');
                                    console.log(data.success);

                                    limpiar();









                              }}
            ,
            error: function (data) {

        console.log("error");
            }
        });





}




    function eliminar() {



        var sel = document.getElementById(sessionStorage.getItem("lista"));
        var text= sel.options[sel.selectedIndex].text;

        Swal.fire({
              title: '¿Estás seguro?',
              text: "Se eliminara el producto: "+text,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Confirmar',
              cancelButtonText: 'Cancelar',
            }).then((result) => {
              if (result.value) {




eliminarConfirmado();
$('#nombreCambio').val('');
$('#precioCambio').val('');








  }
})






      }










      $(document).click(function(event) {
        varlistaActual= $(event.target).parent()[0].id;
        if(varlistaActual!=null){
            getPrecio();
            getNombre();

            sessionStorage.setItem("lista",varlistaActual);
         sessionStorage.setItem("idProd",document.getElementById(varlistaActual).value);
        }

    });












    function getPrecio()
    {




        if(varlistaActual!=null){




            id=document.getElementById(varlistaActual).value;

            $.ajax({
              url:"/precio/"+id,
              method:"get",
              data:{
                  id:id,
              },
              dataType:"json",
              timeout: 50000,
              success:function(data)
              {

                  document.getElementById('precioCambio').value=data;

              }


            });


        }




    }
    function getNombre()
    {

        id=document.getElementById(varlistaActual).value;

      $.ajax({
        url:"/nombre/"+id,
        method:"get",
        data:{
            id:id,
        },
        dataType:"json",
        timeout: 50000,
        success:function(data)
        {

            document.getElementById('nombreCambio').value=data;

        }


      });


    }













    function ordenar(){

    listas=['primero','segundo','postre','bebida'];

    for(var i=0;i<listas.length;i++){
        $("#"+listas[i]).append($("#"+listas[i]+ " option")
                                  .remove().sort(function(a, b) {
                    var at = $(a).text(),
                        bt = $(b).text();
                    return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
                }));

    }

    }





@endsection
@section("title")
Productos
@endsection
@include('menu')
