


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>




      <div class="row">
    </select><button class="btn btn-danger" onclick="eliminar()">Eliminar</button>
    <button class="btn btn-success" id="agregar">Agregar</button>


    <button class="btn btn-success" id="agregarProducto">Agregar Producto</button>


        <div class="col-sm-4" style="background-color:white;">   <h1>Primeros</h1>  <select id="primeros" size=3>

            <?php
$limite=count($primeros);
for($i=0;$i<$limite;$i++){
    echo '<option value="'.$primeros[$i].'">'.$primeros[$i].'</option>';

}
?>


        </select></div>


        <div class="col-sm-4" style="background-color:white;">  <h1>Segundos</h1>  <select id="segundos" size=3>
            <?php
            $limite=count($segundos);
            for($i=0;$i<$limite;$i++){
                echo '<option value="'.$segundos[$i].'">'.$segundos[$i].'</option>';

            }
            ?>

</select></div>

        <!--
        <button class="btn btn-danger" onclick="eliminar()">Eliminar Plato</button>
        <button class="btn btn-success" id="guardar">Guardar Menu</button></div>  -->

        <div class="col-sm-4" style="background-color:white;"> <h1>Postres</h1>   <select id="postres" size=3>
            <?php
            $limite=count($postres);
            for($i=0;$i<$limite;$i++){
                echo '<option value="'.$postres[$i].'">'.$postres[$i].'</option>';

            }
            ?>

        </select></div>

        <div class="col-sm-4" style="background-color:white;"> <h1>Bebidas</h1>   <select id="postres" size=3>
            <?php
            $limite=count($bebidas);
            for($i=0;$i<$limite;$i++){
                echo '<option value="'.$bebidas[$i].'">'.$bebidas[$i].'</option>';

            }
            ?>

        </select></div>


        <div class="col-sm-4" style="background-color:white;"> <h1>Pedido</h1>   <select id="pedido" size=3>
        <option value="cocacola  6$">cocacola  6$</option>


        </select></div>

</div>



















<input list="brow" id="productoElegido">
<datalist id="brow">
    <?php
    $limite=count($productosNombre);
    for($i=0;$i<$limite;$i++){
    echo '<option value="'.$productosNombre[$i].'">'.$productosNombre[$i].'</option>';

    } ?>
</datalist>



<p id="precio">Precio: </p>

<script>


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

function eliminar() {
  var x = document.getElementById(varlistaActual);


  if(x!=null){
    x.remove(x.selectedIndex);
  }
  compruebaVacios();
}




$("#agregar").click(function (e) {
        e.preventDefault();

    var producto= document.getElementById(varlistaActual).value;

                                var sel = document.getElementById("pedido");


                                var opt = document.createElement('option');


                                opt.appendChild( document.createTextNode(document.getElementById(varlistaActual).value) );

                                opt.value = producto;

                                // add opt to end of select box (sel)
                                sel.appendChild(opt);


    });






















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


                                opt.appendChild( document.createTextNode(lastValue ));

                                opt.value = lastValue;

                                // add opt to end of select box (sel)
                                sel.appendChild(opt);

      }


    });



  }






function calcularPrecio(){
    var myOpts = document.getElementById('pedido').options;
          var suma=0;
          for(i=0;i<myOpts.length;i++){
                suma+=Number(myOpts[i].value .replace(/[^0-9\.]+/g,""));

          }

precioMessagge=document.getElementById("precio").textContent;
document.getElementById("precio").textContent=precioMessagge+suma;
}




    $("#agregarProducto").click(function (e) {
        e.preventDefault();

    var producto= document.getElementById('productoElegido').value;
    console.log(producto);
    var precio=getPrecio(producto);

                                var sel = document.getElementById("pedido");


                                var opt = document.createElement('option');


                                opt.appendChild( document.createTextNode(producto ));

                                opt.value = producto;

                                // add opt to end of select box (sel)
                                sel.appendChild(opt);


    });
</script>
