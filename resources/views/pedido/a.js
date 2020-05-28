function refresh() {
    $.ajax({
        url: "/getPedidos",
        method: "get",
        data: {},
        dataType: "json",
        success: function(data) {
            limite = data.length;
            var div = document.getElementById("resultado");

            var contenido = "";
            for (var i = 0; i < limite; i++) {
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
            div.innerHTML = contenido;
        }
    });
}



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



if(data[i].estado!=null){

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



                    contenido+="<br>   <button  class='btn btn-success' name='id' onclick='confirmar(this)' value='"+data[i]._id+"'>TERMINADO</button> " ;








                  /*  contenido+="<br><p class='marcado'>PREPARANDO</p> " ;*/



                    contenido+=" <button  class='btn btn-warning' name='id' onclick='modificar(this)' value='"+data[i]._id+"'>MODIFICAR PEDIDO</button> " ;
                    contenido+=" <button  class='btn btn-danger' name='id' onclick='eliminar(this)' value='"+data[i]._id+"'>ELIMINAR PEDIDO</button> " ;






                        contenido+="<pre class='marcado2'>Listo</pre> " ;
                      contenido+="<pre class='marcado2' id='"+data[i].precio+  "' hidden  value='"+data[i].precio+  "' ></pre> " ;

                    contenido+=" <button  class='btn btn-warning' name='id' onclick='agregarCaja(this)' value='"+data[i]._id+"'>ENVIAR CAJA</button> " ;






                 //   @endif





                    //


                }

                contenido+=" </div>";

            }




        div.innerHTML = contenido;

    }});
    }
