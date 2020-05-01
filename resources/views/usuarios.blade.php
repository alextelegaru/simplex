






<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<html>



<head>



    <style>




 p {
margin-top: 0;
margin-bottom: 0;
line-height: /* adjust to tweak wierd fonts */;
}
    </style>
</head>
<body>

    <div class="container mt-5 border-primary">
        <div class="row">


    <?php

    $limite=count($usuarios);
    function roleado($id){
        if($id==0){
            return "Admin";
        }else{

            if($id==1){
            return "Camarero";
        }else{
            return "Cocinero";



        }


        }

    }



    ?>

    @for ($i = 0; $i <$limite; $i++)





          <div class="col-md-3 clearfix border-primary">
            <div class="card clearfix limite border-primary">
            <img src="{{URL::to('/')}}/img/index.jpg" alt="card-1" class="card-img-top clearfix" height="150px" width="100px">

              <div class="card-body clearfix ">
                <div class="text-center">
                    <p><?php echo roleado($usuarios[$i]['rol'])  ?></p>
                    <p>{{$usuarios[$i]['name']}}</p>

                    <div class="btn-group-vertical">
                    <a href="/usuario/{{$usuarios[$i]['id']}}" class="btn btn-warning">Editar</a>
                    <a href="/usuario/{{$usuarios[$i]['id']}}" class="btn btn-danger">Eliminar</a>
                    </div>




                  </div>





          </div>
        </div>
      </div>








    @endfor


</div>

</div>







<div id="demo">
<h2>The XMLHttpRequest Object</h2>
<button type="button" onclick="loadDoc()">Change Content</button>
</div>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =this.responseText;



    }
  };
  xhttp.open("GET", "/usuarios", true);
  xhttp.send();
}






</script>

</body>
</html>
