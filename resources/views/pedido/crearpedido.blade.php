
@extends('layouts.app')

@section('content')


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>




<style>
.error {
    border-color:red;
}

    #precio{
        color: red;
        width: 17%;
    }


select {
    width: 90%;

}/*
body {
        overflow: hidden;
    }*/
option:hover{background-color:#05f5e9;}
.subrayado{
  text-decoration-line: underline;
}
</style>

<div class="text-center" id="mensaje" style="display:none"></div>
<div class="container">

    <div class="row">




        <div class="col-sm-4" style="background-color:white;">   <h3>Primeros</h3>  <select id="primeros" size=5>

            <?php
$limite=count($primeros);
for($i=0;$i<$limite;$i++){
    echo '<option value="'.$primeros[$i].'">'.$primeros[$i].'</option>';

}
?>


        </select>

    </div>




        <div class="col-sm-4" style="background-color:white;">  <h3>Segundos</h3>  <select id="segundos" size=5>
            <?php
            $limite=count($segundos);
            for($i=0;$i<$limite;$i++){
                echo '<option value="'.$segundos[$i].'">'.$segundos[$i].'</option>';

            }
            ?>

</select></div>


<div class="col-sm-4" style="background-color:white;"> <h3>Postres</h3>   <select id="postres" size=5>
    <?php
    $limite=count($postres);
    for($i=0;$i<$limite;$i++){
        echo '<option value="'.$postres[$i].'">'.$postres[$i].'</option>';

    }
    ?>

</select></div>

<div class="col-sm-4" style="background-color:white;"> <h3>Bebidas</h3>   <select id="bebidas" size=5>
    <?php
    $limite=count($bebidas);
    for($i=0;$i<$limite;$i++){
        echo '<option value="'.$bebidas[$i].'">'.$bebidas[$i].'</option>';

    }
    ?>

</select>
<button class="btn btn-success" id="agregar">Agregar Al Menu</button></div>

<div class="col-sm-4" style="background-color:white;">

    <h3>Buscar Producto</h3>

    <input list="brow" id="productoElegido" width="">
    <datalist id="brow">
        <?php
        $limite=count($productosNombre);
        for($i=0;$i<$limite;$i++){
        echo '<option value="'.$productosNombre[$i].'">'.$productosNombre[$i].'</option>';

        } ?>
    </datalist>

    <button class="btn btn-success" id="agregarProducto">Agregar Producto</button>
<br>
<form class="form-horizontal">
    <h2>Datos Pedido</h2>
                <div class="control-group">
                    <label class="control-label" for="mesa">NºMesa</label>
                    <div class="controls">

    <input type="number" name="mesa" id="mesa" placeholder="0">
                    </div>
                </div>
                <div class="control-group">

                    <div class="controls form-inline">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Obligatorio">

                    </div>
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" placeholder="Opcional" >

                </div>
                <button id="crearPedido" class="btn btn-success">Crear Pedido</button>
            </form>











</div>


<div class="col-sm-4" style="background-color:white;"> <h2>Pedido</h2>   <select id="pedido" size=7>
    <option value="Menu: Vacio">Menu: Vacio</option>


    </select>



    <strong>PRECIO</strong><strong><pre id="precio">  </pre></strong><button class="btn btn-danger" onclick="eliminar()">Eliminar</button></div>














        <div class="col-sm-1" style="background-color:white;">




          </div>


</div>






















        <!--
        <button class="btn btn-danger" onclick="eliminar()">Eliminar Plato</button>
        <button class="btn btn-success" id="guardar">Guardar Menu</button></div>  -->









</div>















@endsection





@section("script")
calcularPrecio();



$(document).ready(function() {
    $(document).click(function(event) {
    varlistaActual= $(event.target).parent()[0].id;
});
});




function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").css("display", "none");
  }, 2000);
}




function eliminar() {

var x = document.getElementById('pedido');

    var posicionEliminar=$("#pedido").prop('selectedIndex');


    var valorAQuitar = document.getElementById("pedido").value;



    if(valorAQuitar.includes("Menu:")){




            quitarMenu(posicionEliminar);
            quitarMenu(posicionEliminar);
            quitarMenu(posicionEliminar);
            quitarMenu(posicionEliminar);
            quitarMenu(posicionEliminar);


    }else{

        if(valorAQuitar.includes("Primero:") ||valorAQuitar.includes("Segundo:") || valorAQuitar.includes("Postre:")||valorAQuitar.includes("Bebida:") ){
alert("Seleccione Menu para eliminarlo.")
        }else{
            if(x!=null){
    x.remove(x.selectedIndex);
        }





  }






    }


    var pedido=  $("#pedido option").map(function() {return $(this).val();}).get();
    if(pedido.length==0){


var sel = document.getElementById("pedido");
var opt = document.createElement('option');
opt.appendChild( document.createTextNode("Menu: Vacio"));

opt.value ="Menu: Vacio";

sel.appendChild(opt);
    }



/*
if(posicionEliminar==0){

    var lista = document.getElementById('pedido');

                for(var i=0;i<4;i++){
                    lista.remove(lista.i);
                }

}

if(posicionEliminar>0 && posicionEliminar <4){

var lista = document.getElementById('pedido');

            for(var i=0;i<4;i++){
                lista.remove(lista.i);
            }

}




if(posicionEliminar>=4){
  //var x = document.getElementById(varlistaActual);
  var x = document.getElementById("pedido");

  if(x!=null){
    x.remove(x.selectedIndex);
  }


}

*/




calcularPrecio();
}






$("#agregar").click(function (e) {
        e.preventDefault();


        //var tipoDelista=varlistaActual;


        var tipoDelista= varlistaActual[0].toUpperCase() +  varlistaActual.slice(1);
tipoDelista = tipoDelista.substring(0, tipoDelista.length - 1);


       // if(comprobarSiTipoYaEstaEnPedido(varlistaActual)){



            var myOpts = document.getElementById('pedido').options;

var posicion=-1;
                for(var i=0;i<myOpts.length;i++){
                    if (myOpts[i].text.includes(tipoDelista)){
                        posicion=i;
                    }
                }


 var producto= document.getElementById(varlistaActual).value;
if(posicion>-1){


    document.getElementById('pedido' ).options[posicion].text = tipoDelista+": "+document.getElementById(varlistaActual).value;
    document.getElementById('pedido' ).options[posicion].value = tipoDelista+": "+document.getElementById(varlistaActual).value;
}else{



if(varlistaActual=="primeros"){
    $("#pedido option[value='Menu: Vacio']").remove();

    var producto= document.getElementById(varlistaActual).value;

    var sel = document.getElementById("pedido");


var opt = document.createElement('option');



opt.appendChild( document.createTextNode("Menu: "+{{$precio}}+"€"));

opt.value = "Menu: "+{{$precio}}+"€";

sel.appendChild(opt);





setTimeout(function(){
var sel = document.getElementById("pedido");
var opt = document.createElement('option');
opt.appendChild( document.createTextNode("Primero: "+producto));
opt.value = "Primero: "+producto;
sel.appendChild(opt);
}, 50);


setTimeout(function(){
var sel = document.getElementById("pedido");
var opt = document.createElement('option');
opt.appendChild( document.createTextNode("Segundo: vacio"));
opt.value = "Segundo: vacio";
sel.appendChild(opt);
}, 50);

setTimeout(function(){
var sel = document.getElementById("pedido");
var opt = document.createElement('option');
opt.appendChild( document.createTextNode("Postre: vacio"));
opt.value = "Postre: vacio";
sel.appendChild(opt);
}, 50);

setTimeout(function(){
var sel = document.getElementById("pedido");
var opt = document.createElement('option');
opt.appendChild( document.createTextNode("Bebida: vacio"));
opt.value = "Bebida: vacio";
sel.appendChild(opt);
}, 50);





}else{

    //alert("Debes agregar un primero");
    $("#mensaje").attr('class', 'alert-success');
    jQuery('.alert-success').show();
    jQuery('.alert-success').append('<p>'+"Para menu agregar un primer plato."+'</p>');




    limpiar();





}




/*


var sel = document.getElementById("pedido");


var opt = document.createElement('option');



opt.appendChild( document.createTextNode(tipoDelista+": "+document.getElementById(varlistaActual).value) );

opt.value = producto;

// add opt to end of select box (sel)
sel.appendChild(opt);*/

}







     /*   }{



        }
*/


calcularPrecio();
    });




function comprobarSiTipoYaEstaEnPedido(varlistaActual){

    var tipoDelista=varlistaActual;


    tipoDelista= tipoDelista[0].toUpperCase() +  tipoDelista.slice(1);



tipoDelista = tipoDelista.substring(0, tipoDelista.length - 1);
var myOpts = document.getElementById('pedido').options;

for(var i=0;i<myOpts.length;i++){
        if(myOpts[i].value.includes(tipoDelista)){
           return false;
        }
}
return true;

}






















    function getPrecio(id)
  {
    $.ajax({
      url:"/precio",
      method:"get",
      data:{'id': id},
      dataType:"json",
      timeout: 50000,
      success:function(data)
      {


        x=data.success;





        var theSelect = document.getElementById('pedido');
var lastValue = theSelect.options[theSelect.options.length - 1].value;
$("#pedido option:contains('"+lastValue+"')").remove();
lastValue+="  "+x+" €";
var sel = document.getElementById("pedido");


                                var opt = document.createElement('option');


                                opt.appendChild( document.createTextNode("Producto: "+lastValue ));

                                opt.value = "Producto: "+lastValue;

                                // add opt to end of select box (sel)
                                sel.appendChild(opt);

      }


    });



  }



function quitarMenu(posicionEliminar){
    var selectobject = document.getElementById("pedido");
    for (var i=posicionEliminar; i<posicionEliminar+1; i++) {
        selectobject.remove(i);
}
}



function calcularPrecio(){
    var myOpts = document.getElementById('pedido').options;
          var suma=0;
          for(i=0;i<myOpts.length;i++){
                suma+=Number(myOpts[i].value .replace(/[^0-9\.]+/g,""));

          }




precioMessagge=document.getElementById("precio").textContent;
document.getElementById("precio").textContent=parseFloat(suma).toFixed(2);
}




    $("#agregarProducto").click(function (e) {
        e.preventDefault();
var producto= document.getElementById('productoElegido').value;

if(producto!=null && producto!=""){



    $("#pedido option[value='Menu: Vacio']").remove();


    var precio=getPrecio(producto);

                                var sel = document.getElementById("pedido");


                                var opt = document.createElement('option');


                                opt.appendChild( document.createTextNode(producto ));

                                opt.value = producto;
                                $('#productoElegido').val('');
                                // add opt to end of select box (sel)
                                sel.appendChild(opt);
                                setTimeout(function() {
                                    calcularPrecio();
}, 1000);
















}













    });



    $("#crearPedido").click(function (e) {
        e.preventDefault();

    var nombre= document.getElementById("nombre").value;
    var email= document.getElementById("email").value;
    var mesa= document.getElementById("mesa").value;
    var pedido=  $("#pedido option").map(function() {return $(this).val();}).get();
    var precio= document.getElementById("precio").textContent;

        var token = '{{csrf_token()}}';
        var data={
            email:email,
            nombre:nombre,
            mesa:mesa,
            pedido:pedido,
            precio:precio,
            _token:token,
            _method:'POST'}
        $.ajax({
            type: "POST",
            url: '/pedidos',
            timeout:7000,
            data: data,
            success: function (data) {





                var original=data.success.toLowerCase();
var hasNumber = /\d/;
if(hasNumber.test(data.success)){

    $("#mesa").removeClass("error");
    $("#nombre").removeClass("error");
    $("#email").removeClass("error");


    var mensaje =  original.slice(2);
    if(original.includes("mesa")){
        document.getElementById("mesa").focus();
        $("#mesa").addClass("error");
        $('#mesa').val('');

    }
    if(original.includes("nombre")){
        $("#nombre").addClass("error");
        document.getElementById("nombre").focus();
        $('#nombre').val('');

    }

    if(original.includes("correo")){
        $("#email").addClass("error");
        document.getElementById("email").focus();
        $('#email').val('');

    }

    if(original.includes("realizado")){

        $("#mensaje").attr('class', 'alert-success');
        jQuery('.alert-success').show();
        jQuery('.alert-success').append('<p>'+mensaje.replace(/\b\w/g, l => l.toUpperCase())+'</p>');
    }else{

        $("#mensaje").attr('class', 'alert-danger');
        jQuery('.alert-danger').show();
        jQuery('.alert-danger').append('<p>'+mensaje.replace(/\b\w/g, l => l.toUpperCase())+'</p>');

    }










}

//pedido correcto
if(original.includes("realizado")){
    $("#mensaje").attr('class', 'alert-success');
    jQuery('.alert-success').show();
    jQuery('.alert-success').append('<p>'+original.replace(/\b\w/g, l => l.toUpperCase())+'</p>');

    $('#email').val('');
    $('#nombre').val('');
    $('#mesa').val('');
    $('#productoElegido').val('');
    $('#pedido').empty();

     $("#mesa").removeClass("error");
    $("#nombre").removeClass("error");
    $("#email").removeClass("error");

    var sel = document.getElementById("pedido");
var opt = document.createElement('option');
opt.appendChild( document.createTextNode("Menu: Vacio"));

opt.value ="Menu: Vacio";

sel.appendChild(opt);
    calcularPrecio();



}

limpiar();


            }
            ,
            error: function (data) {

       console.log("error");


            }


        });


    });









@endsection


@include('menu')

