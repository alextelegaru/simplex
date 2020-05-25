<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>




<div id="resultado" class="row">




</div>






<script>

@if (Auth::user()->rol=="cocinero")

refresh();


setInterval(function(){
    refresh(); // this will run after every 5 seconds


jQuery('#resultado div').html('');


},10000);

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

        var contenido="<div >";
        for(var i = 0; i < limite; i++)
        {















                if(data[i].estado==false){
                    contenido+="              <div class='container-fluid text-center'>    <h5>";
                contenido+="<strong>Mesa:"+data[i].nMesa+"</strong>";

                contenido+="      </h5>   ";

               // contenido+="   <input type='hidden' id='id' name='id' value='"+data[i]._id+"'>";




var limite5=data[i].menu.length;
for(var o=0;o<limite5;o++){
    contenido+=data[i].menu[o]+"<br>";

}






                contenido+="";

                contenido+=data[i].productos;

                //contenido+="<h5>";


                    contenido+="<br>   <button  class='btn btn-success' name='id' onclick='confirmar(this)' value='"+data[i]._id+"'>TERMINADO</button> " ;

                    //contenido+="Estado: "+"PREPARANDO" ;




                contenido+=" </div></div>";






                }










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
            alert('ok');
        },
        error: function(result) {
            alert('error');
        }
    });






}



@endif









refresh();


setInterval(function(){
    refresh(); // this will run after every 5 seconds


jQuery('#resultado div').html('');


},10000);

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
  }

  </script>
