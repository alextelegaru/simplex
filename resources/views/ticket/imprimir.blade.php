


<div class="col-xs-1 center-block">
<h1>Ticket Simplex</h1>
<?php
echo $fecha."<br>";
if($pedido->menu){
echo "<strong><u>Menu</u></strong>"."<br>"."<br>";
$limite=count($pedido->menu);

for($i=0;$i<$limite;$i++){

echo $pedido->menu[$i]."<br>";
}
}
if($pedido->productos){
echo "<br><strong><u>Productos</u></strong>"."<br>";
$limite=count($pedido->productos);

for($i=0;$i<$limite;$i++){

echo $pedido->productos[$i]."<br>";
}
}
echo "<br><strong>TOTAL: ".$pedido->precio."€ (IVA.incluido)</strong>"."<br>";
echo "<br>EFECTIVO:     ".$pago."€<br>";
echo "<br>CAMBIO:       ".$cambio."€"."<br>";
echo "<br><strong>Fue atendido amablemente por ".$nombre."</strong><br>";
echo "Hasta la próxima";


?>

</div>



