


<!--

<!DOCTYPE html>
<html>
  <head>
    <title>Crear Menu</title>

</head>
  <body>
  -->


    @extends('layouts.app')
    @section('content')



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>



<style>option:hover{background-color:#05f5e9;}
        select {
    width: 100%;
}</style>

 <div class="text-center" id="mensaje" style="display:none"></div>


    <br />
    <div class="container">
      <h3 align="center">Creando Menu</h3>
      <br />



















      <strong>Fecha:</strong>  <input type="date" id="myDate" name="fecha"
      value=@isset($fecha){{ $fecha }}@endisset
      min="2018-01-01" >

      <strong>Precio:  </strong><input type="number" id="precio" step="any" name="precio"><strong>€</strong>











      <div class="row">

        <div class="col-sm-4" style="background-color:white;">   <h1>Primeros</h1>  <select id="primeros" size=5>

        </select></div>


        <div class="col-sm-4" style="background-color:white;">  <h1>Segundos</h1>  <select id="segundos" size=5>

        </select><button class="btn btn-danger" onclick="eliminar()">Eliminar Plato</button>
        <button class="btn btn-success" id="guardar">Guardar Menu</button></div>

        <div class="col-sm-4" style="background-color:white;"> <h1>Postres</h1>   <select id="postres" size=5>

        </select></div>




      </div>


      <button class="btn btn-primary" onclick="load_Data('primero')">Ver Primeros</button>
      <button class="btn btn-primary" onclick="load_Data('segundo')">Ver Segundos</button>
      <button class="btn btn-primary" onclick="load_Data('postre')">Ver Postres</button>

      <div class="panel panel-default">
        <div class="panel-heading">Creador de menus</div>
        <div class="panel-body">
          <div class="form-group">
            <label>Busqueda </label>
            <select name="text" id="text" class="form-control input-lg" data-live-search="true" title="Seleccione plato">

            </select>
          </div>






          <div class="row">

            <div class="col-sm-4" style="background-color:white;"> <img src= "/img/soup.png"  width="45px" height="42px" >  <button class="btn btn-success" onclick="añadirPrimeros()">Añadir a Primero</button></div>


            <div class="col-sm-4" style="background-color:white;">  <img src= "/img/plato.png"  width="45px" height="42px" >           <button class="btn btn-success" onclick="añadirSegundos()">Añadir a Segundo</button></div>

            <div class="col-sm-4" style="background-color:white;">  <img src= "/img/postre.png"  width="45px" height="42px" >         <button class="btn btn-success" onclick="añadirPostres()">Añadir a Postre</button></div>




          </div>


        </div>
      </div>
    </div>

@endsection

<!--

  </body>
</html>

<script>
-->



@section('script')


//miFecha();
load_Data('primero');
compruebaVacios();
function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").css("display", "none");
  }, 2000);
}

function load_Data(tipo)
  {
    $.ajax({
      url:"/search",
      method:"get",
      data:{'tipo': tipo},
      dataType:"json",
      success:function(data)
      {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count]+'">'+data[count]+'</option>';
        }

          $('#text').html(html);
          $('#text').selectpicker('refresh');

      }
    })
  }



  function miFecha() {
  var myDate = document.getElementById('myDate');
  var today = new Date();
  myDate.value = today.toISOString().substr(0, 10);
}



function añadirPrimeros(){

    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("primeros");
select.appendChild(option);

compruebaVacios();

}

function añadirSegundos(){
    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("segundos");
select.appendChild(option);
compruebaVacios();
}

function añadirPostres(){
    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("postres");
select.appendChild(option);
compruebaVacios();
}

$('p').on('click', function(){
    $(this).closest("p").remove();
});

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}




function compruebaVacios(){
    if (document.getElementById('primeros').options.length == 0 ){
        var option = document.createElement("option");
        option.text = "Vacio";
        option.value ="vacio";
        var select = document.getElementById("primeros");
select.appendChild(option);

    }else{
        if (document.getElementById('primeros').options.length >1 ){

        var selectobject = document.getElementById('primeros');
for (var i=0; i<selectobject.length; i++) {
    if (selectobject.options[i].value == 'vacio')
        selectobject.remove(i);
}}





         }


    if (document.getElementById('segundos').options.length == 0 ){
        var option = document.createElement("option");
        option.text = "Vacio";
        option.value ="vacio";
        var select = document.getElementById("segundos");
select.appendChild(option);
    }else{
        if (document.getElementById('segundos').options.length >1 ){

var selectobject = document.getElementById('segundos');
for (var i=0; i<selectobject.length; i++) {
if (selectobject.options[i].value == 'vacio')
selectobject.remove(i);
}}

    }







    if (document.getElementById('postres').options.length == 0 ){
        var option = document.createElement("option");
        option.text = "Vacio";
        option.value ="vacio";
        var select = document.getElementById("postres");
select.appendChild(option);
    }else{
        if (document.getElementById('postres').options.length >1 ){

var selectobject = document.getElementById('postres');
for (var i=0; i<selectobject.length; i++) {
if (selectobject.options[i].value == 'vacio')
selectobject.remove(i);
}}
    }
}





$(document).click(function(event) {
    varlistaActual= $(event.target).parent()[0].id;
});






function eliminar() {
  var x = document.getElementById(varlistaActual);


  if(x!=null){
    x.remove(x.selectedIndex);
  }
  compruebaVacios();

}



/*

$("#guardar").click(function(e) {
    e.preventDefault();
    var primeros= $("#primeros option").map(function() {return $(this).val();}).get();
var segundos= $("#primeros option").map(function() {return $(this).val();}).get();
var postres= $("#primeros option").map(function() {return $(this).val();}).get();
    $.ajax({
        type: "POST",
        url: "menu",
        data: {primeros:primeros,

        },
        success: function(result) {
            alert('ok');
        },
        error: function(result) {
            alert('error');
        }
    });
});
*/$("#guardar").click(function (e) {
    e.preventDefault();
    var primeros= $("#primeros option").map(function() {return $(this).val();}).get();
    var segundos= $("#segundos option").map(function() {return $(this).val();}).get();
    var postres= $("#postres option").map(function() {return $(this).val();}).get();
    var fecha=document.getElementById("myDate").value;
    var precio=document.getElementById("precio").value;
    var token = '{{csrf_token()}}';
    var data={
        primeros:primeros,
        _token:token,
        segundos:segundos,
        postres:postres,
        fecha:fecha,
        precio:precio};
    $.ajax({
        type: "post",
        url: "{{route('menu.store')}}",
        data: data,
        success: function (msg) {


           if(msg.success.includes("precio")){
            $("#mensaje").attr('class', 'alert-danger');
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').append('<p>'+msg.success+'</p>');
            document.getElementById("precio").focus()


           }else{
            $("#mensaje").attr('class', 'alert-success');
            jQuery('.alert-success').show();
            jQuery('.alert-success').append('<p>'+msg.success+'</p>');

           }




           limpiar();



        },
        error: function (msg) {
                alert(msg.error);
        }


    });
});









//$('#precio').val('');

//$('#myDate').val()=$('#myDate').val();

@endsection



@include('menu')

