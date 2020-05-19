

@extends('layouts.app')

@section('content')



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>



<style>
        select {
    width: 80%;

}
body {
        overflow: hidden;
    }
option:hover{background-color:#05f5e9;}
.subrayado{
  text-decoration-line: underline;
}

</style>
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
        <div class="panel-heading"><strong>Producto Nuevo</strong></div>
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
                    <button class="btn btn-success" id="crear">Crear Producto</button>
                    <button class="btn btn-danger" id="eliminar" onclick="eliminar()">Eliminar Producto</button>
            </div>
            </div>
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
      }, 1150);
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






















    $("#crear").click(function (e) {
        e.preventDefault();

    var nombre= document.getElementById("nombre").value;
    var tipo= document.getElementById("tipo").value;

        var token = '{{csrf_token()}}';
        var data={
            tipo:tipo,
            nombre:nombre,
            _token:token,
            _method:'POST'}
        $.ajax({
            type: "POST",
            url: '/productos',
            data: data,
            success: function (data) {

                              if(data.success){
                                substring=data.success.split(":");
                                $("#mensaje").attr('class', 'alert-success');
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







                              }



            }
            ,
            error: function (data) {

       console.log("error");


            }


        });
    });





    function eliminar() {


    aEliminar=document.getElementById(varlistaActual).value;
    var x = document.getElementById(varlistaActual);
    x.remove(x.selectedIndex);
    var token = '{{csrf_token()}}';
    var data={
        _token:token,
        _method:'delete'}
    $.ajax({
        type: "POST",
        url: '/productos/'+aEliminar,
        data: data,
        success: function (data) {
                          if(data.success){
                            $("#mensaje").attr('class', 'alert-success');
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










      $(document).click(function(event) {
        varlistaActual= $(event.target).parent()[0].id;
    });






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

@include('menu')
