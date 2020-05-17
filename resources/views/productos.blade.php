





<!DOCTYPE html>
<html>
  <head>
    <title>Edición Productos</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>



<style>
        select {
    width: 100%;
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
echo '<option value="'.$ids[$i].'">'.$primeros[$i].'</option>';

}
?>

</select>



</div>

<div class="col-sm-4" style="background-color:white;">   <h1>Segundos</h1>  <select id="segundo" size=5>

    <?php
$limite=count($segundos);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$ids[$i].'">'.$segundos[$i].'</option>';

}
?>

</select></div>
<div class="col-sm-4" style="background-color:white;">   <h1>Postres</h1>  <select id="postre" size=5>

    <?php
$limite=count($postres);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$ids[$i].'">'.$postres[$i].'</option>';

}
?>

</select>

</div>
<div class="col-sm-4" style="background-color:white;">   <h1>Bebidas</h1>  <select id="bebida" size=5>

    <?php
$limite=count($bebidas);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$ids[$i].'">'.$bebidas[$i].'</option>';

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
  </body>








  <script>






function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").css("display", "none");
  }, 5000);
}

/*
$(document).click(function(event) {
    varlistaActual= $(event.target).parent()[0].id;
});
*/



















/*



$("#crear").click(function (e) {
    e.preventDefault();

    //var aEliminar=document.getElementById(varlistaActual).value;

    //var selectobject = document.getElementById(varlistaActual);


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




                          if(data.success){/*
                            $("#mensaje").attr('class', 'alert-success');
                            jQuery('.alert-success').show();
                  			jQuery('.alert-success').append('<p>'+data.success+'</p>');
                              limpiar();



                var primeros= $("#"+tipo+ "option").map(function() {return $(this).val();}).get();
               // primeros.push(data.success);
                    //primeros.sort();

                   // console.log(primeros);


                   var sel = document.getElementById(tipo);


var opt = document.createElement('option');


opt.appendChild( document.createTextNode(document.getElementById("nombre").value) );

opt.value = data.success;

// add opt to end of select box (sel)
sel.appendChild(opt);



                          }



        }
        ,
        error: function (data) {

   console.log("error");


        }


    });
});
*/




function eliminar() {



var aEliminar=document.getElementById(varlistaActual).value;


/*


var lista=$("#primero option").map(function() {return $(this).val();}).get();
if(lista.includes(aEliminar)){

 $("#primero option[value='" + aEliminar + "']").remove();
}

var lista=$("#segundo option").map(function() {return $(this).val();}).get();
if(lista.includes(aEliminar)){

 $("#segundo option[value='" + aEliminar + "']").remove();
}

var lista=$("#postre option").map(function() {return $(this).val();}).get();
if(lista.includes(aEliminar)){

 $("#postre option[value='" + aEliminar + "']").remove();
}

var lista=$("#postre option").map(function() {return $(this).val();}).get();
*/

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
                      }
    }
    ,
    error: function (data) {

console.log("error");
    }
});















  }










  $(document).click(function(event) {
    varlistaActual= $(event.target).parent()[0].id;
});




  </script>
</html>
