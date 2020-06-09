

    @extends('layouts.app')

    @section('content')
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>-->

    <script type="text/javascript" src="{{URL::asset('js/jquery/3.3.1/jquery.js')}}"></script>
    <link href="{{ asset('css/bootstrap/4.3.1/css/bootstrap.min.css') }}" rel="stylesheet">

   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->

      <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
      <script type="text/javascript" src="{{URL::asset('js/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">-->
    <link href="{{ asset('css/bootstrap-select/1.12.2/css/bootstrap-select.min.css') }}" rel="stylesheet">


    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>-->
          <script type="text/javascript" src="{{URL::asset('js/bootstrap-select/1.12.2/js/bootstrap-select.min.js')}}"></script>







 <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>-->

 <script type="text/javascript" src="{{URL::asset('npm/sweetalert2@9')}}"></script>

    <link href="{{ asset('css/pedido/pedidos.css') }}" rel="stylesheet">


<input type="text" id="nombreLogueado" value={{Auth::user()->name}} hidden>

<div class="container">
@if (\Session::has('success'))
<div class="alert alert-danger">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif

<div class="text-center" id="mensaje" style="display:none"></div>





@if (Auth::user()->rol=="camarero" ||Auth::user()->rol=="camarera" ||Auth::user()->rol=="admin" )


<div id="caja" class=" container-fluid">
<div>
<h1>Caja</h1>
<select id="cajas" size=7>
    <option value="Vacio">Vacio</option>


    </select>

</div>
<strong>TOTAL</strong><pre id="precio" class="anchoPrecio text-center display-4">0.0</pre>
<strong>Recibido</strong><input type="text" id="dineroDado"  onkeyup="calcular()"><br>
 <pre type="text" class="text-center pagar display-4" id="cambio" >0.0</pre>

 <button class="btn btn-success block pagar" id="imprimir" onclick="imprimir(this)" >Cobrar E Imprimir</button><br>
<button class="btn btn-danger block pagar" id="cobrar" onclick="cobrar(this)">Cobrar</button>

<h1>Pedidos</h1>
</div>

<br><br>
@endif


<div id="resultado" class="row ">




</div>


<button onclick="topFunction()" id="myBtn" title="Go to top">Ir Arriba</button>



<audio id="audio" src="http://www.soundjay.com/button/beep-07.wav" autostart="false" ></audio>
</div>
@endsection

@section('script')
function PlaySound() {
      var sound = document.getElementById("audio");
      sound.play()
  }
function calcular(){
precio=parseFloat(document.getElementById("precio").textContent);
dado=Math.abs(document.getElementById("dineroDado").value);
if(dado>=precio){
// alert(dado-precio);
// value = Math.Truncate(100 * value) / 100;
var num = dado-precio,
num= num.toFixed(2);
//var with2Decimals = num.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];

document.getElementById("cambio").textContent=num.toString()+"€";

}else{
document.getElementById("cambio").textContent=0.0+"€";
}


}



refresh();

setInterval(function(){
$("#resultado").empty();
var div = document.getElementById('resultado');

div.innerHTML="";


//jQuery('#resultado div').html('');

 refresh(); // this will run after every 5 seconds





},50000);



function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").css("display", "none");
  }, 2000);
}



function refresh() {
    $.ajax({
        url: "/getPedidos",
        method: "get",
        data: {},
        dataType: "json",
        success: function(data) {






            @if (Auth::user()->rol=="cocinero" ||Auth::user()->rol=="cocinera"||Auth::user()->rol=="admin" )
            $("#mensaje").text('');
    $("#mensaje").css("display", "none");
            $("#mensaje").attr('class', 'alert-warning text-center');
            jQuery('.alert-warning').show();
        jQuery('.alert-warning').append('<p>'+"Esperando pedidos."+'</p>');


@endif

            limite = data.length;
            var div = document.getElementById("resultado");

            var contenido = "";
            for (var i = 0; i < limite; i++) {



                @if (Auth::user()->rol=="camarero" ||Auth::user()->rol=="camarera")

                if(data[i].estado!=null){


                contenido +=
                    "              <div class='col-sm-2' id='" +
                    data[i]._id +
                    "'>    <h5>";
                contenido += "<strong>Mesa:" + data[i].nMesa + "</strong>";

                contenido += "      </h5>   ";

                // contenido+="   <input type='hidden' id='id' name='id' value='"+data[i]._id+"'>";

                var limite5 = data[i].menu.length;
                for (var o = 0; o < limite5; o++) {
                    contenido += "<p>" + data[i].menu[o] + "</p" + "<br>";
                }

                contenido += "";

                contenido += "<p>" + data[i].productos + "</p>";





/*
                contenido +=
                    "<br>   <button  class='btn btn-success' name='id' onclick='confirmar(this)' value='" +
                    data[i]._id +
                    "'>TERMINADO</button> ";

*/






                if (data[i].estado == false) {
                    contenido +=
                        " <button  class='btn btn-warning' name='id' onclick='modificar(this)' value='" +
                        data[i]._id +
                        "'>MODIFICAR PEDIDO</button> ";
                    contenido +=
                        " <button  class='btn btn-danger' name='id' onclick='eliminar(this)' value='" +
                        data[i]._id +
                        "'>ELIMINAR PEDIDO</button> ";
                } else {




                    contenido += "<pre class='marcado2'>Listo</pre> ";




                    contenido +=
                        "<pre class='marcado2' id='" +
                        data[i].precio +
                        "' hidden  value='" +
                        data[i].precio +
                        "' ></pre> ";







                    contenido +=
                        " <button  class='btn btn-warning' name='id' onclick='agregarCaja(this)' value='" +
                        data[i]._id +
                        "'>ENVIAR A CAJA</button> ";







                    setTimeout(function() {
                        PlaySound();
                    }, 3000);
                }

                contenido += " </div>";












                }

@endif



@if (Auth::user()->rol=="admin" )





if(data[i].estado!=null){


contenido +=
    "              <div class='col-sm-2' id='" +
    data[i]._id +
    "'>    <h5>";
contenido += "<strong>Mesa:" + data[i].nMesa + "</strong>";

contenido += "      </h5>   ";

// contenido+="   <input type='hidden' id='id' name='id' value='"+data[i]._id+"'>";

var limite5 = data[i].menu.length;
for (var o = 0; o < limite5; o++) {
    contenido += "<p>" + data[i].menu[o] + "</p" + "<br>";
}

contenido += "";

contenido += "<p>" + data[i].productos + "</p>";




if(data[i].estado==false){


contenido +=
    "<br>   <button  class='btn btn-success' name='id' onclick='confirmar(this)' value='" +
    data[i]._id +
    "'>TERMINADO</button> ";

}






if (data[i].estado == false) {
    contenido +=
        " <button  class='btn btn-warning' name='id' onclick='modificar(this)' value='" +
        data[i]._id +
        "'>MODIFICAR PEDIDO</button> ";
    contenido +=
        " <button  class='btn btn-danger' name='id' onclick='eliminar(this)' value='" +
        data[i]._id +
        "'>ELIMINAR PEDIDO</button> ";
} else {




    contenido += "<pre class='marcado2'>Listo</pre> ";




    contenido +=
        "<pre class='marcado2' id='" +
        data[i].precio +
        "' hidden  value='" +
        data[i].precio +
        "' ></pre> ";







    contenido +=
        " <button  class='btn btn-warning' name='id' onclick='agregarCaja(this)' value='" +
        data[i]._id +
        "'>ENVIAR CAJA</button> ";







    setTimeout(function() {
        PlaySound();
    }, 3000);
}

contenido += " </div>";












}
















@endif








@if (Auth::user()->rol=="cocinero" ||Auth::user()->rol=="cocinera")

$("#nombre").removeClass("error");






                if(data[i].estado==false){
                   // limpiar();
                   $("#mensaje").text('');
    $("#mensaje").css("display", "none");
                contenido +=
                    "              <div class='col-sm-2' id='" +
                    data[i]._id +
                    "'>    <h5>";
                contenido += "<strong>Mesa:" + data[i].nMesa + "</strong>";

                contenido += "      </h5>   ";

                // contenido+="   <input type='hidden' id='id' name='id' value='"+data[i]._id+"'>";

                var limite5 = data[i].menu.length;
                for (var o = 0; o < limite5; o++) {
                    contenido += "<p>" + data[i].menu[o] + "</p" + "<br>";
                }

                contenido += "";

                contenido += "<p>" + data[i].productos + "</p>";






                contenido +=
                    "<br>   <button  class='btn btn-success' name='id' onclick='confirmar(this)' value='" +
                    data[i]._id +
                    "'>TERMINADO</button> ";








            /*    if (data[i].estado == false) {
                    contenido +=
                        " <button  class='btn btn-warning' name='id' onclick='modificar(this)' value='" +
                        data[i]._id +
                        "'>MODIFICAR PEDIDO</button> ";
                    contenido +=
                        " <button  class='btn btn-danger' name='id' onclick='eliminar(this)' value='" +
                        data[i]._id +
                        "'>ELIMINAR PEDIDO</button> ";
                } else {
*/


/*
                    contenido += "<pre class='marcado2'>Listo</pre> ";




                    contenido +=
                        "<pre class='marcado2' id='" +
                        data[i].precio +
                        "' hidden  value='" +
                        data[i].precio +
                        "' ></pre> ";




                    contenido +=
                        " <button  class='btn btn-warning' name='id' onclick='agregarCaja(this)' value='" +
                        data[i]._id +
                        "'>ENVIAR CAJA</button> ";

*/





                    setTimeout(function() {
                        PlaySound();
                    }, 3000);
               // }

                contenido += " </div>";












                }
@endif
















            }//fin for
            div.innerHTML = contenido;























        }
    });
}



function confirmar(objButton){


    $("#"+objButton.value).remove();
var id=objButton.value;
var token = '{{csrf_token()}}';
$.ajax({
    type: "POST",
    url: "confirmar/"+id,
    data: {id:id,
        "_token": token,

    },
    success: function(result) {


        $("#mensaje").attr('class', 'alert-success');
jQuery('.alert-success').show();
jQuery('.alert-success').append('<p>'+result+'</p>');
limpiar();
    },
    error: function(result) {
        alert('error');
    }
});






}

function agregarCaja(bjButton){
document.getElementById("cobrar").value=bjButton.value;
document.getElementById("imprimir").value=bjButton.value;
$("#cajas option[value='Vacio']").remove();


@if (Auth::user()->rol=="camarero" ||Auth::user()->rol=="camarera")

var element = document.getElementById(bjButton.value);
var numberOfChildren = element.getElementsByTagName('*').length;
//alert(numberOfChildren);

var limite=document.getElementById(bjButton.value).childNodes.length-6;
@endif

@if (Auth::user()->rol=="admin")
var limite=document.getElementById(bjButton.value).childNodes.length-10;
@endif





$('#cajas')
    .empty();



var info="";
for(var i=3;i<limite;i++){
info=document.getElementById(bjButton.value).childNodes[i].innerText;

/*if(info.includes(",")){

platosDiferentes=info.split(",");
limiteP=platosDiferentes.length;
for(var i=0;i<limiteP;i++){
    x=platosDiferentes[i];
    $('#cajas').append(new Option(x,x));
}
}*/
$('#cajas').append(new Option(info, info));
}




var data;

var token = '{{csrf_token()}}';

$.ajax({
type: "GET",
url: "/getCoste/"+bjButton.value,
data: {

},
success: function (data) {
    $('#precio').text(data+"€");

                  }
,
error: function (data) {

console.log("error");
}
});
































}


function modificar(objButton){
var baseUrl = document.location.origin;



window.location.href = baseUrl+"/modificar/"+objButton.value;

}




function cobrar(objButton){

$("#"+objButton.value).remove();
/*
var baseUrl = document.location.origin;
url = baseUrl+"/cobrar/"+objButton.value;
*/

$("#dineroDado").removeClass("error");
$("#nombre").removeClass("error");
    precio=parseFloat(document.getElementById("precio").textContent);
dado=Math.abs(document.getElementById("dineroDado").value);



if(dado>=precio){



    var token = '{{csrf_token()}}';
var id=objButton.value;
$.ajax({
type: "GET",
url: "/cobrar/"+id,
timeout: 20000,
data: {

},
success: function (data) {

if(data.success){

    $("#mensaje").attr('class', 'alert-success text-center');
                    jQuery('.alert-success').show();
                      jQuery('.alert-success').append('<p>'+data.success+'</p>');



                      $('#cajas').empty();
                      document.getElementById("precio").textContent="0.0";
                      document.getElementById("dineroDado").value="";
                      document.getElementById("cambio").textContent="0.0";

                      limpiar();
                      $("#cajas").append(new Option("Vacio", "Vacio"));
}




                  }
,
error: function (data) {

console.log("error");
}
});








}else{


    document.getElementById("dineroDado").focus();
    $("#dineroDado").addClass("error");
    $("#mensaje").attr('class', 'alert-danger');
                    jQuery('.alert-danger').show();
                      jQuery('.alert-danger').append('<p>'+"Cantidad insuficiente."+'</p>');
                limpiar();



}













}



function getName(){
var data;

var token = '{{csrf_token()}}';

$.ajax({
type: "GET",
url: "/getName",
data: {

},
success: function (data) {
 alert(data);





                  }
,
error: function (data) {

console.log("error");
}
});



}




function getDineroDado(){

    return  document.getElementById("dineroDado").value;
}


 function getCambio(){
    return  document.getElementById("cambio").textContent.substring(0,document.getElementById("cambio").textContent.length - 1);
}








 function imprimir(objButton){
    objButton=objButton;
    $("#nombre").removeClass("error");
    precio=parseFloat(document.getElementById("precio").textContent);
dado=Math.abs(document.getElementById("dineroDado").value);



if(dado>=precio){

    var data;
/*
var token = '{{csrf_token()}}';

$.ajax({
type: "GET",
url: "/getName",
timeout: 25000,
data: {

},
success: function (data) {


 var token = '{{csrf_token()}}';*/


var id=objButton.value;
var pago=   document.getElementById("dineroDado").value;
var numero=document.getElementById("cambio").textContent.length - 1;
var cambio= document.getElementById("cambio").textContent.substring(0,numero);


var baseUrl = document.location.origin;
urlx="imprimir/"+id+"/"+pago+"/"+cambio+"/"+data;
window.open(urlx, '_blank');

/*

                  }
,
error: function (data) {

console.log("error");
}
});*/
//cobrar(objButton);
$("#mensaje").attr('class', 'alert-success text-center');
jQuery('.alert-success').show();
  jQuery('.alert-success').append('<p>'+"Pedido Cobrado"+'</p>');



  $('#cajas').empty();
  document.getElementById("precio").textContent="0.0";
  document.getElementById("dineroDado").value="";
  document.getElementById("cambio").textContent="0.0";
  $("#"+objButton.value).remove();
  $("#cajas").append(new Option("Vacio", "Vacio"));
  limpiar();


}else{







    document.getElementById("dineroDado").focus();
    $("#dineroDado").addClass("error");
    $("#mensaje").attr('class', 'alert-danger text-center');
                    jQuery('.alert-danger').show();
                      jQuery('.alert-danger').append('<p>'+"Cantidad insuficiente."+'</p>');
limpiar();



}




}












function eliminar(objButton) {

var id=objButton.value;
sessionStorage.setItem("idEliminar",id);



Swal.fire({
      title: '¿Estás seguro?',
      text: "Se eliminara el pedido seleccionado.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar'
    }).then((result) => {
      if (result.value) {


var token = '{{csrf_token()}}';
var data={
_token:token,
_method:'delete'}
$.ajax({
type: "POST",
url: '/pedidos/'+id,
data: data,
success: function (data) {
                  if(data.success){
                    $("#mensaje").attr('class', 'alert-success');
                    jQuery('.alert-success').show();
                      jQuery('.alert-success').append('<p>'+data.success+'</p>');
                        console.log(data.success);
                        document.getElementById(sessionStorage.getItem("idEliminar")).remove();

                  }}
,
error: function (data) {

console.log("error");
}
});





  }
})






}









/*
function refresh()
{




$.ajax({
  url:"/modificar/1/a",
  method:"get",
  data:{},
  dataType:"json",
  success:function(data)
  {

    alert(data.menu);

    alert(data.productos);



}
});
}*/
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
@endsection


@section("title")
Pedidos
@endsection
@include('menu')
