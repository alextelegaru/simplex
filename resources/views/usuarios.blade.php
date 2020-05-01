






<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<html>
<body>

    <div class="container mt-5 border-primary">
        <div class="row">


    <?php

    $limite=count($usuarios);


    ?>

    @for ($i = 0; $i <$limite; $i++)





          <div class="col-md-3 clearfix border-primary">
            <div class="card clearfix limite border-primary">
                      <img src="url({{ URL::asset('store/index.jpg') }}" alt="card-1" class="card-img-top clearfix">
              <img src="img/iphone 11 plus.jpg" alt="card-1" class="card-img-top clearfix">
              <div class="card-body clearfix ">
                <div class="text-center">
                    <p>Nombre: {{$usuarios[$i]['name']}}</p>
                    <a href="/usuario/{{$usuarios[$i]['id']}}">Modificar</a>
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
