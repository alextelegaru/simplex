<?php
use App\producto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */









    function precioRandom(){
                 $min=1.25;
                $max=34.5;
                return rand ($min*10, $max*10) / 10;
    }



    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('tipo');
            $table->float('precio');
            $table->timestamps();
        });


       // $precios=[3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25,3.25];

        $primeros=["Consome al Gusto",
        "Sopa Castellana",
        "Pochas Estofadas con Perdiz",
        "Ensalada de Perdiz Escabechada con Setas y sus Verduras",
        "Ensalada de Tomate con Bonito y Piparras",
        "Ensalada de Escarola con Tomate Pelado y Ajos Fritos",
        "Clasicos de Casa Ciriaco",
        "Gallina en Pepitoria",
        "Callos a la Madrileña",
        "Albondigas de Ternera",
        "Cocido Madrileño Completo Dos vuelcos"];

        sort($primeros);
$limite=count($primeros);
for($i=0;$i<$limite;$i++){
    producto::create([
        'nombre' => $primeros[$i],
        'tipo' =>"primero",
        'precio' =>$this->precioRandom(),
    ]);


}




$segundos=["Arroz con Perdiz y Verduras",
"Arroz con Boletus y Foie",
"Arroz caldoso con langosta",
"Bacalao Rebozado Clasico con Guarnicion",
"Tronco de Merluza a la Donostiarra con Langostinos",
"Chipirones en su Tinta",
"Lenguado Casa Ciriaco",
"Cogote de Merluza a la Bilbaina",
"Entrecot de Carne Roja",
"Solomillo de Cebon con Guarnicion",
"Ossobuco con Pure de Boniato",
"Rabo Estofado",
"Paletilla de Cordero Lechal Asada"];

sort($segundos);
$limite=count($segundos);
for($i=0;$i<$limite;$i++){
    producto::create([
        'nombre' => $segundos[$i],
        'tipo' =>"segundo",
        'precio' =>$this->precioRandom(),
    ]);


}


$postres=["Natilla",

"Torrija Castiza",

"Arroz con Leche",

"Cuajada con Miel",

"Cheesecake Con Helado",

"Ponche Segoviano",

"Leche Frita",

"Sorbete de Cherry con Vodka y Aromas de Naranja",

"Helado (Dos sabores)"];

sort($postres);
$limite=count($postres);
for($i=0;$i<$limite;$i++){
    producto::create([
        'nombre' => $postres[$i],
        'tipo' =>"postre",
        'precio' =>$this->precioRandom(),
    ]);


}





$bebidas=["Agua",

"Fanta Naranja",

"Fanta Limon",

"Aquarius Naranja",

"Cafe cortado",

"Cafe descafeinado",

"Cafe con leche",

"Cocacola",

"Cocacola Light",
"Cocacola Zero",
"Pepsi",
"Nestea",
"Trina Naranja",
"Cerveza",

];

sort($bebidas);
$limite=count($bebidas);
for($i=0;$i<$limite;$i++){
    producto::create([
        'nombre' => $bebidas[$i],
        'tipo' =>"bebida",
        'precio' =>$this->precioRandom(),
    ]);


}
















    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {



    Schema::connection($this->connection)->drop('productos');

    }
}
