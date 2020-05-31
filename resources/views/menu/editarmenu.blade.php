


    @extends('layouts.app')
    @section('content')







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






    <div class="" id="mensaje" style="display:none"></div>






    <br />
    <div class="container">
      <h3 align="center" class="subrayado">Editando Menu</h3>
      <br />
















      <button class="btn btn-info black" onclick="ir()"    >Cargar Datos De Otro Dia</button><input type="date"  style="font-size: 2rem" style="color:black;" id="fechaEdicion" name="fechaEdicion"><br><br>


      <strong>Menu del dia:</strong>  <input type="date" id="myDate" name="fecha"
      value= {{$fecha}}
      min="2018-01-01" >

      <strong>Precio:  </strong><input type="number" id="precio" step="any" value="<?php echo (float)$precio;?>" name="precio"><strong>€</strong>











      <div class="row">

        <div class="col-sm-4" style="background-color:white;">   <h1>Primeros</h1>  <select id="primeros" size=5>

            <?php
$limite=count($primeros);
for($i=0;$i<$limite;$i++){
    echo '<option value="'.$primeros[$i].'">'.$primeros[$i].'</option>';

}
?>

        </select></div>


        <div class="col-sm-4" style="background-color:white;">  <h1>Segundos</h1>  <select id="segundos" size=5>
            <?php
$limite=count($segundos);
for($i=0;$i<$limite;$i++){
    echo '<option value="'.$segundos[$i].'">'.$segundos[$i].'</option>';

}
?>
        </select><button class="btn btn-danger" onclick="eliminar()">Eliminar Plato</button>
        <button class="btn btn-success" id="guardar">Guardar</button></div>

        <div class="col-sm-4" style="background-color:white;"> <h1>Postres</h1>   <select id="postres" size=5>
            <?php
$limite=count($postres);
for($i=0;$i<$limite;$i++){
    echo '<option value="'.$postres[$i].'">'.$postres[$i].'</option>';

}
?>
        </select></div>




      </div>


      <button class="btn btn-primary" onclick="load_Data('primero')">Ver Primeros</button>
      <button class="btn btn-primary" onclick="load_Data('segundo')">Ver Segundos</button>
      <button class="btn btn-primary" onclick="load_Data('postre')">Ver Postres</button>

      <div class="panel panel-default">
        <div class="panel-heading">Editador de menus</div>
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


@section('script')





//miFecha();
load_Data('primero');
compruebaVacios();
ordenar();


function ir(){

    var fechaEdicion=document.getElementById("fechaEdicion").value
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    $(location).attr('href', baseUrl+"/"+fechaEdicion);



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





  function ordenar(){

listas=['primeros','segundos','postres','bebidas'];

for(var i=0;i<listas.length;i++){
    $("#"+listas[i]).append($("#"+listas[i]+ " option")
                              .remove().sort(function(a, b) {
                var at = $(a).text(),
                    bt = $(b).text();
                return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
            }));

}

}










/*

  function load_Data(tipo)
  {
      var fecha=document.getElementById('myDate').value;
    $.ajax({
      url:"menu/"+fecha,
      method:"edit",
      data:{'fecha': fecha},
      dataType:"json",
      success:function(data)
      {

       alert(data);

      }
    })
  }
*/




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
ordenar();
}

function añadirSegundos(){
    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("segundos");
select.appendChild(option);
compruebaVacios();ordenar();
}

function añadirPostres(){
    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("postres");
select.appendChild(option);
compruebaVacios();ordenar();
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
*/
$("#guardar").click(function (e) {
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
        precio:precio,
        _method:'PUT'}
    $.ajax({
        type: "PUT",
        url: '/menu/'+fecha,
        data: data,
        success: function (data) {
            jQuery.each(data.errors, function(key, value){
                $("#mensaje").attr('class', 'alert-danger text-center');
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<p>'+value+'</p>');
                  		});

                          if(data.success){
                            $("#mensaje").attr('class', 'alert-success text-center');
                            jQuery('.alert-success').show();
                  			jQuery('.alert-success').append('<p>'+data.success+'</p>');


                          }
limpiar();


        }
        ,
        error: function (data) {

            jQuery.each(data.errors, function(key, value){
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<p>'+value+'</p>');
                              alert(value);
                  		});
                          limpiar();


        }


    });
});




/*

$('#div#question_preview <some button selector>').click(function() {
        $.ajax({
                url: 'questions/'+question_id,
                type: 'PATCH',
                data: {status: <SOME VALUE I WANT>, _method: "PATCH"},
                success: function(res) {

                }
        });
});

*/


function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").css("display", "none");



  }, 5000);
}



$("#mensaje").on("click", function(event) {
    $("#mensaje").text('');
    $("#mensaje").css("display", "none");
    event.preventDefault();
});







function reiniciar(){}

//miFecha();














@endsection


@include('menu')
