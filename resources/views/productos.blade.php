





<!DOCTYPE html>
<html>
  <head>
    <title>Edición Menu</title>
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

<div class="col-sm-4" style="background-color:white;">   <h1>Primeros</h1>  <select id="primeros" size=5>

    <?php
$limite=count($primeros);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$ids[$i].'">'.$primeros[$i].'</option>';

}
?>

</select>



</div>

<div class="col-sm-4" style="background-color:white;">   <h1>Segundos</h1>  <select id="segundos" size=5>

    <?php
$limite=count($segundos);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$ids[$i].'">'.$segundos[$i].'</option>';

}
?>

</select></div>
<div class="col-sm-4" style="background-color:white;">   <h1>Postres</h1>  <select id="postres" size=5>

    <?php
$limite=count($postres);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$ids[$i].'">'.$postres[$i].'</option>';

}
?>

</select>

</div>
<div class="col-sm-4" style="background-color:white;">   <h1>Bebidas</h1>  <select id="bebidas" size=5>

    <?php
$limite=count($bebidas);
for($i=0;$i<$limite;$i++){
echo '<option value="'.$ids[$i].'">'.$bebidas[$i].'</option>';

}
?>

</select>


</div>








<div class="col-sm-4" style="background-color:white;">
<br><br><br>
    <button class="btn btn-danger" id="eliminar">Eliminar Producto</button>
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


$(document).click(function(event) {
    varlistaActual= $(event.target).parent()[0].id;
});










$("#eliminar").click(function (e) {
    e.preventDefault();

    var aEliminar=document.getElementById(varlistaActual).value;

    var selectobject = document.getElementById(varlistaActual);
for (var i=0; i<selectobject.length; i++) {
if (selectobject.options[i].value == document.getElementById(varlistaActual).value)
selectobject.remove(i);
}




    var token = '{{csrf_token()}}';
    var data={

        _token:token,

        _method:'POST'}
    $.ajax({
        type: "DELETE",
        url: '/productos/'+aEliminar,
        data: data,
        success: function (data) {


                          if(data.success){
                            $("#mensaje").attr('class', 'alert-success');
                            jQuery('.alert-success').show();
                  			jQuery('.alert-success').append('<p>'+data.success+'</p>');
                              limpiar();


                          }



        }
        ,
        error: function (data) {

   console.log("error");


        }


    });
});



function eliminar() {
  var x = document.getElementById(varlistaActual);
  if(x!=null){
    x.remove(x.selectedIndex);
  }
}
  </script>
</html>
