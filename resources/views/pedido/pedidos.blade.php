<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>



<style>

.marcado {
            background-color: yellow;
            color: red;
            width: 75%;
         }
         .marcado2 {
            background-color: green;
            color: white;
            width: 75%;
         }

         #caja{
             margin-left: 70%;
         }


         #precio{
        color: red;
        width: 17%;
    }
</style>
@if (\Session::has('success'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

<div class="text-center" id="mensaje" style="display:none"></div>

<div id="caja" class=" container-fluid">
    <div>
    <h1>Caja</h1>
    <select id="cajas" size=7>
        <option value="Vacio">Vacio</option>


        </select>

    </div>
    <strong>PRECIO</strong><strong><pre id="precio">  </pre></strong>
</div>
<br><br><br><br><br>



<div id="resultado" class="row ">




</div>







<script>




refresh();

setInterval(function(){
    $("#resultado").empty();
    var div = document.getElementById('resultado');

    div.innerHTML="<div class=' container-fluid' id='mensaje' style='display:none'></div>";


    //jQuery('#resultado div').html('');

     refresh(); // this will run after every 5 seconds





},100000);

function refresh()
  {




    $.ajax({
      url:"/getPedidos",
      method:"get",
      data:{},
      dataType:"json",
      success:function(data)
      {

        limite=data.length;
        var div = document.getElementById('resultado');

        var contenido="";
        for(var i = 0; i < limite; i++)
        {
















                    contenido+="              <div class='col-sm-2' id='"+data[i]._id+"'>    <h5>";
                contenido+="<strong>Mesa:"+data[i].nMesa+"</strong>";

                contenido+="      </h5>   ";

               // contenido+="   <input type='hidden' id='id' name='id' value='"+data[i]._id+"'>";




var limite5=data[i].menu.length;
for(var o=0;o<limite5;o++){
    contenido+="<p>"+data[i].menu[o]+"</p"+"<br>";

}






                contenido+="";

                contenido+="<p>"+data[i].productos+"</p>";

                //contenido+="<h5>";
                    @if (Auth::user()->rol=="cocinero" ||Auth::user()->rol=="cocinera" ||Auth::user()->rol=="admin" )

                    contenido+="<br>   <button  class='btn btn-success' name='id' onclick='confirmar(this)' value='"+data[i]._id+"'>TERMINADO</button> " ;
                    @endif
                    @if (Auth::user()->rol=="camarero" ||Auth::user()->rol=="camarera" ||Auth::user()->rol=="admin" )


                    if(data[i].estado==false){





                  /*  contenido+="<br><p class='marcado'>PREPARANDO</p> " ;*/



                    contenido+=" <button  class='btn btn-warning' name='id' onclick='modificar(this)' value='"+data[i]._id+"'>MODIFICAR PEDIDO</button> " ;
                    contenido+=" <button  class='btn btn-danger' name='id' onclick='eliminar(this)' value='"+data[i]._id+"'>ELIMINAR PEDIDO</button> " ;





                    }else{
                        contenido+="<pre class='marcado2'>Listo</pre> " ;
                      contenido+="<pre class='marcado2' id='"+data[i].precio+  "' hidden  value='"+data[i].precio+  "' ></pre> " ;

                    contenido+=" <button  class='btn btn-warning' name='id' onclick='agregarCaja(this)' value='"+data[i]._id+"'>ENVIAR CAJA</button> " ;
                }





                    @endif





                    //




                contenido+=" </div>";

















        }
        div.innerHTML += contenido;




      }
    })
  }




  function confirmar(objButton){



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
        },
        error: function(result) {
            alert('error');
        }
    });






}

function agregarCaja(bjButton){
var limite=document.getElementById(bjButton.value).childNodes.length;
var info="";
for(var i=3;i<limite-3;i++){
info=document.getElementById(bjButton.value).childNodes[i].innerText;
    $('#cajas').append(new Option(info, info));
}



info=document.getElementById(bjButton.value).children[9].id;
document.getElementById(precio).innerText=info;



}


function modificar(objButton){
    var baseUrl = document.location.origin;



    window.location.href = baseUrl+"/modificar/"+objButton.value;

}




function eliminar(objButton) {
    var id=objButton.value;

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

                      }}
    ,
    error: function (data) {

console.log("error");
    }
});

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

  </script>
